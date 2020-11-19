<?php

namespace frontend\models;

use kekaadrenalin\recaptcha3\ReCaptchaValidator;
use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class ContactForm extends Model
{
    public $name;
    public $email;
    public $phone;
    public $subject;
    public $body;
    public $reCaptcha;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            // name, email, subject and body are required

            [['name', 'email', 'subject', 'body'], 'required'],
            [['phone'], 'k-phone', 'countryValue' => 'ES'],
            // email has to be a valid email address
            ['email', 'email'],
            //reCaptchaV3 google
            [['reCaptcha'], ReCaptchaValidator::className(), 'acceptance_score' => 0]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'name' => 'Nombre',
            'email' => 'Correo electrónico',
            'phone' => 'Teléfono',
            'subject' => 'Asunto',
            'body' => 'Mensaje',
        ];
    }

    /**
     * Sends an email to the specified email address using the information collected by this model.
     *
     * @param string $email the target email address
     * @return bool whether the email was sent
     */
    public function sendEmail($email)
    {
        return Yii::$app->mailer->compose()
            ->setTo($email)
            ->setFrom([Yii::$app->params['senderEmail'] => Yii::$app->params['senderName']])
            ->setReplyTo([$this->email => $this->name])
            ->setSubject($this->subject)
            ->setTextBody("Teléfono de contacto: " . $this->phone . "<br>". $this->body )
            ->send();
    }
}
