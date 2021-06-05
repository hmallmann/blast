<?php
namespace App\Utilities;

use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

class Mailer
{
    protected $mail;
    protected $repository;
    protected $toAdresses;
    protected $mailsCC;
    protected $mailsCCo;
    protected $subject;
    protected $senderName;
    protected $senderAdress;
    protected $body;
    protected $attachments = [];

    /**
     * String with ; then separator
     * @param $toAdresses
     * @return $this
     */
    function setTo($toAdresses)
    {
        $this->toAdresses = str_replace(';', ',', $toAdresses);

        return $this;
    }

    function setCC($emailsCC)
    {
        $this->mailsCC = str_replace(';', ',', $emailsCC);

        return $this;
    }

    function setCCO($emailsCCo)
    {
        $this->mailsCCo = str_replace(';', ',', $emailsCCo);

        return $this;
    }

    function setSubject($subject)
    {
        $this->subject = $subject;

        return $this;
    }

    function ComNomeDoRemetente($nomeRemetente)
    {
        $this->senderName = $nomeRemetente;

        return $this;
    }

    function setSender($emailRemetente)
    {
        $this->senderAdress = $emailRemetente;

        return $this;
    }

    function setBody($corpo)
    {
        $this->body = $corpo;

        return $this;
    }

    function setAttachments($anexos = array())
    {
        $this->attachments = $anexos;
        if(!is_array($this->attachments))
        {
            $this->attachments = [$this->attachments];
        }

        return $this;
    }

    function setRepository($repositorio)
    {
        $this->repository = $repositorio;

        return $this;
    }

    function sendNow()
    {
        try
        {
            $this->mail = new PHPMailer();
            $this->configServer();

            // Assunto
            $this->mail->Subject = mb_convert_encoding ($this->subject, 'latin1');

            // Corpo
            $this->mail->MsgHTML($this->body);

            if(is_array($this->attachments) && count($this->attachments) > 0)
            {
                $this->addAttachmentsToMail();
            }

            if(!$this->send())
            {
                throw new \Exception('Nenhum endereço válido');
            }

        }
        catch(\Exception $e)
        {
            return 'ERRO:' . $e->getMessage();
        }
    }

    private function send()
    {
        if(!is_null($this->toAdresses))
        {
            $destinatarios = explode(',', $this->toAdresses);
            $this->toAdresses = [];
            if(!is_null($destinatarios))
            {
                foreach($destinatarios as $destinatario)
                {
                    $this->toAdresses[] = $destinatario;
                }
            }
            $this->toAdresses = implode(',', $this->toAdresses);
        }

        if(!empty($this->toAdresses))
        {
            if(!is_null($this->mailsCC))
            {
                $emailsCC = explode(',', $this->mailsCC);
                $this->mailsCC = [];
                if(!is_null($emailsCC))
                {
                    foreach($emailsCC as $emailCC)
                    {
                            $this->mailsCC[] = $emailCC;
                    }
                }
                $this->mailsCC = implode(',', $this->mailsCC);
            }

            if(!is_null($this->mailsCCo))
            {
                $emailsCCo = explode(',', $this->mailsCCo);
                $this->mailsCCo = [];
                if(!is_null($emailsCCo))
                {
                    foreach($emailsCCo as $emailCCo)
                    {
                            $this->mailsCCo[] = $emailCCo;
                    }
                }
                $this->mailsCCo = implode(',', $this->mailsCCo);
            }

            return $this->fire();
        }

        return false;
    }

    private function configServer()
    {
        $this->mail->CharSet = 'UTF-8';

        if ( $this->usaSMTP() )
        {
            $this->configMailer();
        }
    }

    private function fire()
    {
        if(!function_exists('mail'))
        {
            throw new Exception('Função para envio de e-mail não encontrada.');
        }
        $this->configSender();

        $this->configRecipients();

        $this->configCopies();

        $this->configHiddenCopies();

        try
        {

        if(!$this->mail->send())
        {
            dd($this->mail);
            throw new \Exception($this->mail->ErrorInfo);
        }
        }
        catch( \Exception $e )
        {
            dd($e);
        }

        return true;
    }

    private function addAttachmentsToMail()
    {
        // Anexos
        if(!empty($this->attachments))
        {
            foreach($this->attachments as $row)
            {
                $strPath = $this->repository . DIRECTORY_SEPARATOR . $row;
                $fileType = mime_content_type($strPath);
                $strFileName = basename($strPath);
                $this->mail->addAttachment($strPath, $strFileName, 'base64', $fileType);
            }
        }
    }

    private function configSender()
    {
        if(empty($this->senderAdress))
        {
            $this->mail->setFrom(env('MAIL_USERNAME', 'site@sistema.dev.br'), 'Site');
        }

        $this->mail->setFrom($this->senderAdress, $this->senderName);
        $this->mail->addReplyTo($this->senderAdress, $this->senderName);
    }

    // Adiciona as destinatarios
    private function configRecipients()
    {
        if(empty($this->toAdresses))
        {
            throw new \Exception('Não foi especificado nenhum destinatário.');
        }

        $destinatarios = is_array($this->toAdresses) ? $this->toAdresses : preg_split('/[;,]/', $this->toAdresses);
        foreach($destinatarios as $destinatario)
        {
            $this->mail->addAddress($destinatario);
        }
    }

    // Adiciona as copias
    private function configCopies()
    {
        $cc = is_array($this->mailsCC) ? $this->mailsCC : preg_split('/[;,]/', $this->mailsCC);
        if(!empty($cc))
        {
            foreach($cc as $destinatarioCC)
            {
                $this->mail->addCC($destinatarioCC);
            }
        }
    }

    // Adiciona as copias ocultas
    private function configHiddenCopies()
    {
        $cco = is_array($this->mailsCCo) ? $this->mailsCCo : preg_split('/[;,]/', $this->mailsCCo);
        if(!empty($cco))
        {
            foreach($cco as $destinatarioBCC)
            {
                $this->mail->addBCC($destinatarioBCC);
            }
        }
    }

    public function configMailer()
    {
        $this->mail = new PHPMailer();
        //$this->mail->SMTPDebug = 3;
        $this->mail->isSMTP();
        $this->mail->Host = env('MAIL_HOST');

        if($this->usaSMTP())
            $this->mail->SMTPAuth = true;

        $this->mail->Username = env('MAIL_USERNAME');
        $this->mail->Password = env('MAIL_PASSWORD');
        $this->mail->Port = env('MAIL_PORT');
        $this->mail->From = env('MAIL_USERNAME');

        // Criptografia dos emails:
        $this->mail->SMTPSecure = env('MAIL_ENCRYPTION', 'ssl');
        if ($this->mail->SMTPSecure == 'tls') // se for tls desabilita algumas coisas (CDL precisou disto)
        {
            $this->mail->SMTPOptions = array(
                'ssl' => array(
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true
                )
            );
        }

        $this->mail->isHTML(true);
    }

    /*
     * Este método verifica se está sendo usado o smtp manual
     * No caso da Tri é automático e não usa as configurações.
     */
    private function usaSMTP()
    {
        return !is_null(env('MAIL_USERNAME') ) && !is_null(env('MAIL_PASSWORD') );
    }
}
