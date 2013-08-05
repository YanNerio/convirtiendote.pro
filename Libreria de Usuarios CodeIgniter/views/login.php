<!--
/*
*  Libreria para manejo de usuarios
*  creada por @guillermo_lc
*  www.convirtiendote.pro y @convirtiendoteP
*/
-->
<? 
    $attributes = array('id' => 'login');
    print form_open('index.php/user/login',$attributes);
?>
        <input type="text" name="email" id="email" placeholder="Email" />
        <?=form_error('email')?>

        <input type="password" name="password" id="password" placeholder="Password" />
        <?=form_error('password')?>

        <button name="submit">Entrar</button>
    </div>
   
</form>