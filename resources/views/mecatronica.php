<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="../Proyecto 7B/estilos.css">
    <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css">

    <style>
#menu{
    background-color: #e4cf4b;
    position: fixed;
    height: 100%;
    width: 230px;
    float: left;
    align-items: center;

}
#categorias{
    color: #ffff;
    font-family: Arial, Helvetica, sans-serif;
}
#boton{
    display: block;
    height: 50px;
    width: 200px;
    padding-top: 5px;
    outline: none;
    border: 1px solid rgb(118, 103, 11);
    background-color: #404040;
    border-radius: 6px;
    color: #fff;
    cursor: pointer;
    transition: all .25s;
    z-index: 1;
    position: relative;
    text-transform: uppercase;
    font-family: Arial, Helvetica, sans-serif;
}
#boton::before{
    content: '';
    position: absolute;
    width: 100%;
    height: 0;
    left: 0;
    bottom: 0;
    background-image: linear-gradient(to right, rgb(118, 103, 11), rgb(118, 103, 11));
    transition: all .25s;
    z-index: -1;
    font-family: Arial, Helvetica, sans-serif;
}
#boton:hover{
    border-radius: 1px solid transparent;
    color: #fff;
    font-family: Arial, Helvetica, sans-serif;
}
#boton:hover::before{
    height: 100%;
}
.wrapper .button{
    display: inline-block;
    height: 75px;
    width: 73px;
    margin: 0 5px;
    overflow: hidden;
    background: #26193a;
    border-radius: 50px;
    cursor: pointer;
    box-shadow: 0px 10px 10px rgba(0, 0, 0, 0.1);
    transition: all 0.2s ease-out;
}
.wrapper .button:hover{
    width: 200px;
}
.wrapper .button .icon{
    display: inline-block;
    height: 60px;
    width: 60px;
    text-align: center;
    border-radius: 50px;
    box-sizing: border-box;
    line-height: 60px;
}
.wrapper .button .icon i{
    font-size: 30px;
    line-height: 60px;
    color: #fff;
    justify-content: center;
    padding-left: 17px;
    padding-top: 5px;

}
.wrapper .button span{
    font-size: 20px;
    font-weight: 500;
    line-height: 60px;
    margin-left: 0px;
    font-family: Arial, Helvetica, sans-serif;
    color: #fff;

}
/* #UserI{
    height: 75px;
    width: 73px;
    border-radius: 80px;
    padding-right: 10px;
    padding-left: 20px;
    border: #26193A;
    background-color: #26193A;
    top: 0;
    left: 0;
}
#UserI:hover{
    width: 200px;
    padding-top: 4px;
    transition: all .25s;
    top: 0;
    left: 0;
}
#ImaUser{
    color: #fff;
    padding-top: 15px;

} */
#Escrito{
    visibility: hidden;
}
#logo{
    height: 91px;
    width: 91px;
    border:#ffff;
    border-color: aqua;
}
#Logo1{
    height: 398px;
    width: 398px;
    display: block;
    margin: auto;
    margin-top: 150px;

}
#fondo{
    background-color: #404040;
}
#fondosl{
    background-color: #404040;
}
#cuadro{
    background-color: #ffff;
}
#cubo{
    padding: 10px;
    /*padding-right: 10px;
    padding-left: 72px;*/
    top: 0;
    left: 0;
    display: block;
}
#busqueda{
    padding-top: 35px;
    padding-left: 180px;
        
}
#buscar{
    height: 43px;
    width: 756px;
    background-color: #404040;
    border-color: #707070;
    padding: 12px;
}
.splash{
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100vh;
    background: #404040;
    z-index: 200;
}
.splash.display-none{
    position: fixed;
    opacity: 0;
    top: 0;
    left: 0;
    width: 100%;
    height: 100vh;
    background: #404040;
    z-index: -10;
    transition: all 0.5s;
}

@keyframes fadeIn{
    to{
        opacity: 1;
    }
}
.fade-in{
    opacity: 0;
    animation: fadeIn 1s ease-in forwards;
}
#prueba{
    color: #fff;
}
#BotonIncio{
    float: right;
}
#sert
{
    text-align: center;
}
.videossss
{
    margin: 0;
    top: 0;
    left: 0;
    display: flex;
    justify-content: center ;
    color: #fff;
}
.titulos
{
    margin: 0;
    top: 0;
    left: 0;
    display: flex;
    justify-content: left ;
    color: #fff;
}
.redes{
    height: 30px;
    width: 30px;
    display: block;
    margin: auto;
    margin-top: 50px;
}

    </style>
    <title>UTTv</title>
</head>
<body id="fondo">
    
    <header id="base">
        <div class="letf_area">
          <div class="splash">
            <img src="Logo.png" alt="" id="Logo1" class="fade-in">
          </div>
          <div class="container" id="menu">
            <div class="row g-2">
               <center> 
                <div class="col-12" id="cubo">
                    <center><img src="Logo.png" id="logo" alt="logo"></center>
                </div>
            </center>
            </div>
            <div class="row g-2">
                <div class="col-12">
                   <center><h3 id="categorias">Categorias</h3></center>
                </div>
            </div>
            <p></p>
            <div class="row g-2">
                <div class="col-12">
                    <button type="button" id="boton" class="btn">Mecatronica</button>
                </div>
            </div>
            <p></p>
            <div class="row g-2">
                <div class="col-12">
                    <button type="button" id="boton" class="btn">Tics</button>
                </div>
            </div>
            <p></p>
            <div class="row">
                <div class="col-12">
                   <div class="wrapper">
                       <div class="button">
                           <div class="icon"><i class="fa fa-user-plus fa-2x"></i></div>
                           <span>Iniciar Sesion</span>
                       </div>
                   </div>
                </div>
            </div>
          </div>
          <div class="container" id="busqueda" style="text-align: center;">
            <input type="text" id="buscar" placeholder="Buscar...">
            <button class="btn" type="submit">
                <i class="fa fa-search fa-2x" id="prueba"></i>
            </button>
           
            <p style="text-align: center;" class="videossss">MECATRONICA</p>

  <div class="videossss">
    <table class="default" style="text-align: center;">
      <tr>
          <td class="separation">
            <img src="facebook.png" width="90" height="90" id="redes" class="fade-in">
            </td>
          <td class="separation">
            <img src="instagram.png" width="100" height="100" id="redes" class="fade-in">
            </td>
          <td class="separation"> 
            <img src="twiter.png" width="100" height="100" id="redes" class="fade-in">
            </td>
      </tr>
    </table>    
  </div>
          </div>
        </div>
    </header>

    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="animaciones.js"></script>
</body>
</html>