<style type="text/css">
.fondo{
    height: 60px;
    display: block;
    text-align: center; 
}
</style>


<body class='login'>

    <div class="wrapper">
        <h1><a href=""><img src="" alt="" class='retina-ready' width="59" height="49">Ocupacional</a></h1>
        <div class="login-body">
            <h2>Inicie sesión</h2>
            <form id="loginform" action="<?php echo base_url()?>index.php/usuarios/login" method='post' class='form-validate' id="test">
                <div class="control-group">
                    <div class="email controls">
                        <input 
                            type="text" 
                            name='usuario' 
                            value="<?php echo set_value('usuario') ?>"
                            placeholder="Nombre de usuario" 
                            class='input-block-level' 
                            data-rule-required="true" 
                        >
                    </div>
                </div>
                <div class="control-group">
                    <div class="pw controls">
                        <input 
                            type="password" 
                            name="password" 
                            placeholder="Contraseña" 
                            class='input-block-level' 
                            data-rule-required="true">
                    </div>
                </div>
                <div class="submit">
                    
                    <input type="submit" value="Iniciar Sesión" class='btn btn-primary'>
                </div>
            </form>
            <div class="fondo">
                <img src="<?php echo base_url() ?>img/cabecera1.png" alt="">

            </div>
            <div class="forget">
                <a href="#"><span>Olvido Contraseña?</span></a>
            </div>
        </div>
    </div>



