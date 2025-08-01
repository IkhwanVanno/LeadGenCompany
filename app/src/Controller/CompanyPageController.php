<?php

use SilverStripe\Control\Email\Email;
use SilverStripe\Control\HTTPRequest;
use SilverStripe\Control\HTTPResponse;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\Form;
use SilverStripe\Forms\FormAction;
use SilverStripe\Forms\RequiredFields;
use SilverStripe\Forms\TextareaField;
use SilverStripe\Forms\TextField;
use SilverStripe\Forms\EmailField;
use SilverStripe\SiteConfig\SiteConfig;
use SilverStripe\Core\Convert;
use SilverStripe\Security\SecurityToken;

class CompanyPageController extends PageController
{
    private static $allowed_actions = [
        'index',
        'view',
        'edit',
        'delete',
        'ContactForm',
    ];

    private static $url_handlers = [
        'view/$ID' => 'view',
        'edit/$ID' => 'edit',
        'delete/$ID' => 'delete',
    ];

    public function init()
    {
        parent::init();
    }

    public function index()
    {
        $Hero = Hero::get();
        $AboutImage = AboutImage::get();
        $Treatments = Treatments::get();
        $Packages = Packages::get();
        $Gallery = Gallery::get();
        $Testimonial = Testimonial::get();
        $Contact = Contact::get();

        return $this->customise([
            'Hero' => $Hero,
            'AboutImage' => $AboutImage,
            'Treatments' => $Treatments,
            'Packages' => $Packages,
            'Gallery' => $Gallery,
            'Testimonial' => $Testimonial,
            'Contact' => $Contact,
        ])->renderWith(['CompanyPage', 'Page']);
    }

    public function view(HTTPRequest $request)
    {
        $id = $request->param('ID');
        if (!$id) {
            return $this->httpError(404, 'Page not found');
        }
    }

    public function edit(HTTPRequest $request)
    {
        $id = $request->param('ID');
        if (!$id) {
            return $this->httpError(404, 'Page not found');
        }
    }

    public function delete(HTTPRequest $request)
    {
        $id = $request->param('ID');
        if (!$id) {
            return $this->httpError(404, 'Page not found');
        }
    }

    public function ContactForm()
    {
        $nameField = TextField::create('UserName', 'Your Name')
            ->addExtraClass('form-control mb-3')
            ->setAttribute('placeholder', 'Enter your name')
            ->setAttribute('required', true);

        $emailField = EmailField::create('UserEmail', 'Your Email')
            ->addExtraClass('form-control mb-3')
            ->setAttribute('placeholder', 'Enter your email')
            ->setAttribute('required', true);

        $messageField = TextareaField::create('Message', 'Message')
            ->addExtraClass('form-control mb-3')
            ->setAttribute('rows', 4)
            ->setAttribute('placeholder', 'Write your message here')
            ->setAttribute('required', true);

        $fields = FieldList::create(
            $nameField,
            $emailField,
            $messageField
        );

        $actions = FieldList::create(
            FormAction::create('handleContactSubmit', 'SEND MESSAGE')
                ->addExtraClass('btn btn-primary btn-lg w-100')
        );

        $validator = RequiredFields::create('UserName', 'UserEmail', 'Message');

        $form = Form::create($this, 'ContactForm', $fields, $actions, $validator);
        $form->addExtraClass('custom-contact-form');

        $form->enableSecurityToken();

        return $form;
    }

    public function handleContactSubmit($data, Form $form, HTTPRequest $request)
    {
        try {
            $userName = Convert::raw2xml($data['UserName']);
            $userEmail = Convert::raw2xml($data['UserEmail']);
            $message = Convert::raw2xml($data['Message']);

            if (!filter_var($userEmail, FILTER_VALIDATE_EMAIL)) {
                $form->sessionMessage('Email tidak valid!', 'bad');
                return $this->redirectBack();
            }

            $contact = Contact::create();
            $contact->UserName = $userName;
            $contact->UserEmail = $userEmail;
            $contact->Message = $message;
            $contact->write();

            $this->sendContactEmail($userName, $userEmail, $message);
            $form->sessionMessage('Pesan berhasil dikirim!', 'good');

        } catch (Exception $e) {
            error_log('Contact form error: ' . $e->getMessage());
            $form->sessionMessage('Terjadi kesalahan saat mengirim pesan. Silakan coba lagi.', 'bad');
        }

        return $this->redirectBack();
    }

    private function sendContactEmail($userName, $userEmail, $message)
    {
        $siteConfig = SiteConfig::current_site_config();

        if (!$siteConfig->Email) {
            throw new Exception('Admin email not configured in SiteConfig');
        }

        $AdminEmails = $this->multipleEmails($siteConfig->Email);

        if (empty($AdminEmails)) {
            throw new Exception('No valid email addresses found in SiteConfig');
        }

        foreach ($AdminEmails as $adminEmail) {
            $email = new Email();
            $email->setTo($adminEmail);
            $email->setFrom($AdminEmails[0]);
            $email->setReplyTo($userEmail);
            $email->setSubject("Pesan Kontak dari: {$userName}");
            $email->setHTMLTemplate('CustomEmail');
            $email->setData([
                'Name' => $userName,
                'SenderEmail' => $userEmail,
                'MessageContent' => $message,
                'SiteName' => $siteConfig->Title,
            ]);

            $email->send();
        }
    }

    private function multipleEmails($emailString)
    {
        $emails = explode(',', $emailString);
        $validEmails = [];

        foreach ($emails as $email) {
            $email = trim($email);
            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $validEmails[] = $email;
            }
        }

        return $validEmails;
    }

    public function getContactForm()
    {
        return $this->ContactForm();
    }
}