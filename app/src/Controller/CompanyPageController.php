<?php

use SilverStripe\Control\HTTPRequest;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\Form;
use SilverStripe\Forms\FormAction;
use SilverStripe\Forms\RequiredFields;
use SilverStripe\Forms\TextareaField;
use SilverStripe\Forms\TextField;

class CompanyPageController extends PageController
{
    private static $allowed_actions = [
        'index',
        'view',
        'edit',
        'delete',
        'ContactForm',
    ];

    public function init()
    {
        parent::init();
        // Additional initialization code can go here
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
        return $this->customise(
            [
                'Hero' => $Hero,
                'AboutImage' => $AboutImage,
                'Treatments' => $Treatments,
                'Packages' => $Packages,
                'Gallery' => $Gallery,
                'Testimonial' => $Testimonial,
                'Contact' => $Contact,
            ]
        )->renderWith(['CompanyPage', 'Page']);
    }

    public function view($id)
    {
        // Logic for viewing a specific company page
    }

    public function edit($id)
    {
        // Logic for editing a specific company page
    }

    public function delete($id)
    {
        // Logic for deleting a specific company page
    }


    public function ContactForm()
    {
        $nameField = TextField::create('UserName', 'Your Name')
            ->addExtraClass('form-control mb-3')
            ->setAttribute('placeholder', 'Enter your name')
            ->setAttribute('required', true);

        $emailField = TextField::create('UserEmail', 'Your Email')
            ->addExtraClass('form-control mb-3')
            ->setAttribute('type', 'email')
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

        return $form;
    }


    public function handleContactSubmit($data, Form $form, HTTPRequest $request)
    {
        $contact = Contact::create();
        $form->saveInto($contact);
        $contact->write();

        $form->sessionMessage('Pesan berhasil dikirim!', 'good');
        return $this->redirectBack();
    }
}