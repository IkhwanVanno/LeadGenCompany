<?php

use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\Form;
use SilverStripe\Forms\FormAction;
use SilverStripe\Forms\TextareaField;
use SilverStripe\Forms\TextField;
use SilverStripe\Forms\RequiredFields;
use SilverStripe\ORM\PaginatedList;
use SilverStripe\Control\HTTPRequest;
use SilverStripe\Control\Director;

class BlogPageController extends PageController
{
    private static $allowed_actions = [
        "index",
        "view",
        "CommentForm",
        "HandleForm",
    ];

    private static $url_handlers = [
        'view/$ID' => 'view',
        'CommentForm' => 'CommentForm',
    ];

    public function init()
    {
        parent::init();
    }

    public function index(HTTPRequest $request = null)
    {
        $KategoriBlog = KategoriBlog::get();
        $blogs = $this->getFilteredBlogs($request);

        return $this->customise([
            "KategoriBlog" => $KategoriBlog,
            "Blog" => $blogs,
            "SearchQuery" => $request ? $request->getVar('search') : '',
            "SelectedCategory" => $request ? $request->getVar('category') : '',
        ])->renderWith(['BlogPage', 'Page']);
    }

    public function view(HTTPRequest $request)
    {
        $id = $request->param('ID');

        if (!$id) {
            return $this->httpError(404, 'Blog ID not provided');
        }

        $blog = Blog::get()->byID($id);

        if (!$blog) {
            return $this->httpError(404, 'Blog tidak ditemukan');
        }

        $comments = CommentBlog::get()->filter('BlogID', $id)->sort('Created DESC');

        return $this->customise([
            'CurrentBlog' => $blog,
            'Title' => $blog->Title,
            'Comments' => $comments,
            'CommentForm' => $this->CommentForm($id)
        ])->renderWith(['BlogDetailPage', 'Page']);
    }

    private function getFilteredBlogs($request)
    {
        $blogs = Blog::get()->sort('Date DESC');

        if ($request && $searchQuery = $request->getVar('search')) {
            $blogs = $blogs->filterAny([
                'Title:PartialMatch' => $searchQuery,
                'Description:PartialMatch' => $searchQuery,
            ]);
        }

        if ($request && $categoryID = $request->getVar('category')) {
            $blogs = $blogs->filter('KategoriBlogID', $categoryID);
        }

        $paginatedBlogs = PaginatedList::create($blogs, $request ?: $this->getRequest());
        $paginatedBlogs->setPageLength(5);
        $paginatedBlogs->setPaginationGetVar('page');

        return $paginatedBlogs;
    }


    public function Blog()
    {
        return $this->getFilteredBlogs($this->getRequest());
    }

    public function PaginationParams()
    {
        $params = [];

        if ($search = $this->getRequest()->getVar('search')) {
            $params['search'] = $search;
        }

        if ($category = $this->getRequest()->getVar('category')) {
            $params['category'] = $category;
        }

        if (!empty($params)) {
            return '&' . http_build_query($params);
        }

        return '';
    }

    public function CommentForm($blogID = null)
    {
        if (!$blogID) {
            $blogID = $this->getRequest()->param('ID');
        }

        $form = Form::create(
            $this,
            'CommentForm',
            FieldList::create(
                TextField::create('Name', 'Nama')
                    ->setAttribute('placeholder', 'Masukkan nama Anda')
                    ->addExtraClass('form-control'),
                TextareaField::create('Comment', 'Komentar')
                    ->setAttribute('placeholder', 'Tulis komentar Anda di sini')
                    ->setAttribute('rows', 3)
                    ->addExtraClass('form-control'),
                TextField::create('BlogID', '')
                    ->setValue($blogID)
                    ->addExtraClass('d-none')
            ),
            FieldList::create(
                FormAction::create('HandleForm', 'Kirim Komentar')
                    ->addExtraClass('btn btn-primary')
            ),
            RequiredFields::create(['Name', 'Comment'])
        );

        $form->addExtraClass('comment-form');
        $form->setFormMethod('POST');

        return $form;
    }

    public function HandleForm($data, $form)
    {
        try {
            $blogID = isset($data['BlogID']) ? intval($data['BlogID']) : null;

            if (!$blogID) {
                $form->sessionMessage('Blog ID tidak valid', 'bad');
                return $this->redirectBack();
            }

            $blog = Blog::get()->byID($blogID);
            if (!$blog) {
                $form->sessionMessage('Blog tidak ditemukan', 'bad');
                return $this->redirectBack();
            }

            $comment = CommentBlog::create();
            $comment->BlogID = $blogID;
            $comment->Name = strip_tags($data['Name']);
            $comment->Comment = strip_tags($data['Comment']);
            $comment->write();

            $form->sessionMessage('Komentar berhasil ditambahkan!', 'good');

            return $this->redirect($this->Link('view/' . $blogID));

        } catch (Exception $e) {
            $form->sessionMessage('Terjadi kesalahan saat menyimpan komentar', 'bad');
            return $this->redirectBack();
        }
    }
}