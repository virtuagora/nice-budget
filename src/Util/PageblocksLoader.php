<?php

namespace App\Util;

use Carbon\Carbon;

class PageblocksLoader
{
  private $db;

  public function __construct($db)
  {
    $this->db = $db;
  }

  public function populate()
  {
    $this->db->table('page_blocks')->insert([
      [
        'id' => 1,
        'title' => 'Intenté registrarme, pero apareció el mensaje: "Error enviando el correo electrónico"',
        'markdown' => 'En primer lugar, revisá si recibiste un correo electrónico para verificar tu registro. Si no recibiste nada, verificá primero estar conectado a internet y volvé a intentarlo.',
        'path' => '/faq',
        'picture_name' => null,
        'hidden' => false,
        'order' => 1,
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now()
      ],
      [
        'id' => 2,
        'title' => 'Me registré correctamente, pero no he recibido el correo electrónico para confirmar',
        'markdown' => 'Revisá si recibiste el correo electrónico en la carpeta de "SPAM" o "Correo no deseado". De no haber recibido el correo, podés volver a intentar registrarte (se intentará enviar otro correo electronico a tu casilla) si el problema persiste, contactanos.',
        'path' => '/faq',
        'picture_name' => null,
        'hidden' => false,
        'order' => 2,
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now()
      ],
      [
        'id' => 3,
        'title' => 'Al iniciar sesión, me informa que no estoy habilitado para votar',
        'markdown' => "¿Estas recibiendo el siguiente mensaje?\n>Usted **no se encuentra habilitado** para votar de forma online\n\nEso ocurre porque en nuestras bases de datos, no te pudimos encontrar en el padrón de votantes habilitados. No te preocupes, aún podés navegar por la web.\n\nSi aún así preferís hacer la votación de forma ONLINE, tenemos que validar tú DNI previo a agregarte al padron de votantes habilitados. Para poder hacerlo, contactanos a nuestro email.",
        'path' => '/faq',
        'picture_name' => null,
        'hidden' => false,
        'order' => 3,
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now()
      ],
    ]);
  }
}
