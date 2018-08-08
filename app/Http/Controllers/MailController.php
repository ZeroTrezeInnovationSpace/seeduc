<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Mail;


class MailController extends Controller {

   private $email = '';

   public function rememberPassword($email, $name){
      $data = array('name'=>"SEEDUC - Semana da Educação",
         'title'=>'SEEDUC - Solicitação de redefinição de senha',
         'name'=> $name);
      $this->email = $email;
      Mail::send('mail.rememberPassword', $data, function($message) {
         $message->to($this->email);
         $message->cc('vinicius@gruporesolv.com.br');
         $message->subject('Solicitação de redefinição de senha');
         $message->from('sco@gruporesolv.com.br','SEEDUC - Semana da Educação');
      });
      return 1;
   }

   }
