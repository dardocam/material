<?php

/**
 *^
 */
class Helpers // extends AnotherClass
{

  //retorna url del proyecto
  public static function base_url()
  {
    return HOME_URL;
  }
  //retorna assets del proyecto
  public static function media()
  {
    return HOME_URL . ASSETS_PATH;
  }
  //muestra información formateada
  public static function dep($data)
  {
    $format = print_r('<pre>');
    $format .= print_r($data);
    $format = print_r('</pre>');
    return $format;
  }
  //elimina exceso de espacios entre palabras
  public static function strClean($strData)
  {
    $str = preg_replace(['/\s+/', '/^\s|\s$/'], [' ', ''], $strData);
    $str = trim($str); //elimina espacios en blanco al inicio y al final
    $str = stripslashes($str); //elimina las \ invertidas
    $str = str_ireplace("<script>", "", $str);
    $str = str_ireplace("</script>", "", $str);
    $str = str_ireplace("</script src>", "", $str);
    $str = str_ireplace("</script type=>", "", $str);
    $str = str_ireplace("..", "", $str);
    $str = str_ireplace("^", "", $str);
    $str = str_ireplace("[", "", $str);
    $str = str_ireplace("]", "", $str);
    $str = str_ireplace("==", "", $str);
    // return pg_escape_string($str);
    return $str;
  }
  //genera una contraseña de 10 caracteres
  public static function passGenerator($lenght = 21)
  {
    $pass = '';
    $longPass = $lenght;
    $str = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890';
    $longStr = strlen($str);
    for ($i = 1; $i < $longPass; $i++) {
      $pos = rand(0, $longStr - 1);
      $pass .= substr($str, $pos, 1);
    }
    return $pass;
  }
  //genera un token
  public static function token()
  {
    $r1 = bin2hex(random_bytes(10));
    $r2 = bin2hex(random_bytes(10));
    $r3 = bin2hex(random_bytes(10));
    $r4 = bin2hex(random_bytes(10));
    $token = $r1 . '-' . $r2 . '-' . $r3 . '-' . $r4;
    return $token;
  }
  //formato para valores monetarios
  public static function formatMoney($cantidad)
  {
    $cantidad = number_format($cantidad, 2, SPD, SPM);
    return S . ' ' . $cantidad;
  }
  public static function require_model($name)
  {
    $name = strtolower($name) . "Model";
    $filename = "models/" . $name . ".php";
    if (file_exists($filename)) {
      require_once($filename);
      return new $name();
    } else {
      throw new Exception("El modelo no existe");
    }
  }

  public static function validar($string)
  {
    $patron_texto = "/^[a-zA-ZáéíóúÁÉÍÓÚäëïöüÄËÏÖÜàèìòùÀÈÌÒÙ\s]+$/";
    if (!preg_match_all($patron_texto, $string)) {
      return $string;
    } else {
      return false;
    }
  }
  public static function test_input($data)
  {
    $data = trim($data);
    $data = substr($data, 0, 253);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    $data = Helpers::strClean($data);
    return $data;
  }
  public static function showInUnits($data)
  {
    return $data . " u.";
  }
  public static function showInMiligrams($data)
  {
    return (string)$data . " ml.";
  }
}
