<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Guia ADV</title>
    <link rel="stylesheet" href="{{asset('assets/site/bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Bitter:400,700">
    <link rel="stylesheet" href="{{asset('assets/site/fonts/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/site/fonts/ionicons.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/site/css/Customizable-Background--Overlay.css')}}">
    <link rel="stylesheet" href="{{asset('assets/site/css/Features-Boxed.css')}}">
    <link rel="stylesheet" href="{{asset('assets/site/css/Features-Clean.css')}}">
    <link rel="stylesheet" href="{{asset('assets/site/css/Footer-Basic.css')}}">
    <link rel="stylesheet" href="{{asset('assets/site/css/Header-Dark.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.1.1/aos.css">
    <link rel="stylesheet" href="{{asset('assets/site/css/Planos.css')}}">
    <link rel="stylesheet" href="{{asset('assets/site/css/Registration-Form-with-Photo.css')}}">
    <link rel="stylesheet" href="{{asset('assets/site/css/styles.css')}}">
    <link rel="stylesheet" href="{{asset('assets/site/css/Team-Boxed.css')}}">
</head>

<body>
    <div>
        <div class="header-dark" style="background-image: url(&quot;{{asset('assets/site/img/intro-bg.png')}}&quot;);">
            <nav class="navbar navbar-light navbar-expand-md">
                <div class="container-fluid"><a class="navbar-brand" href="#">GUIA ADV</a><button data-toggle="collapse" class="navbar-toggler" data-target="#navcol-2"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
                    <div class="collapse navbar-collapse d-xl-flex justify-content-xl-end"
                        id="navcol-2">
                        <ul class="nav navbar-nav">
                            <li class="nav-item" role="presentation"><a class="nav-link active" href="#servicos" style="color: rgba(255,255,255,0.9);">SERVIÇOS</a></li>
                            <li class="nav-item" role="presentation"><a class="nav-link" href="#preco" style="color: #ffffff;">PREÇOS</a></li>
                            <li class="nav-item" role="presentation"><a class="nav-link" href="#depoimentos" style="color: #ffffff;">DEPOIMENTOS</a></li>
                            <li class="nav-item" role="presentation"><a class="nav-link" href="#contato" style="color: #ffffff;">CONTATO</a></li>
                            <li class="nav-item" role="presentation"><a class="nav-link" href="#sobre" style="color: #ffffff;">SOBRE</a></li>
                            <li class="nav-item" role="presentation"><a class="nav-link" href="{{route('login')}}" style="color: #ffffff;">LOGIN</a></li>
                        </ul>
                    </div>
                </div>
            </nav>
            <div class="container hero">
                <div class="row">
                    <div class="col-md-8 offset-md-2">
                        <div class="embed-responsive embed-responsive-16by9">
                            <iframe width="560" height="315" src="https://www.youtube.com/embed/I3peZgn3hBg" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="features-clean" id="servicos" style="padding: 0;">
        <div class="container">
            <div class="intro">
                <h2 class="text-center">MAIS SOBRE NOSSOS SERVIÇOS&nbsp;</h2>
                <p class="text-center">Estamos sempre atualizando o Guia ADV trazendo sempre novidades para melhor atender nossos clientes.<br></p>
            </div>
            <div class="row features">
                <div class="col-sm-6 col-lg-4 item"><i class="fa fa-comments icon" style="color:#4c1982;"></i>
                    <h3 class="name">SUPORTE ESPECIALIZADO</h3>
                    <p class="description">Surgiu dúvida usando nossa plataforma? Temos um suporte especializado para te ajudar.</p>
                </div>
                <div class="col-sm-6 col-lg-4 item"><i class="fa fa-bullhorn icon" style="color:#4c1982;"></i>
                    <h3 class="name">NOVIDADES DO MUNDO JURÍDICO</h3>
                    <p class="description">Estamos sempre acompanhando as novidades da área jurídica para melhor adaptar em nosso sistema.<br></p>
                </div>
                <div class="col-sm-6 col-lg-4 item"><i class="fa fa-group icon" style="color:#4c1982;"></i>
                    <h3 class="name">EQUIPE ESPECIALIZADA</h3>
                    <p class="description">Equipe de desenvolvimento especializada e em constante treinamento.<br></p>
                </div>
            </div>
        </div>
        <div id="sobre"  style="background-image: url(&quot;{{asset('assets/site/img/achievements-bg.jpg')}}&quot;);height: 500px;background-position: center;background-size: cover;background-repeat: no-repeat;">
            <div class="d-flex justify-content-center align-items-center" style="height:inherit;min-height:initial;width:100%;position:absolute;left:0;background-color:rgba(30,41,99,0.53);">
                <div class="d-flex align-items-center order-12" style="height:200px;">
                    <div class="container">
                        <div class="row">
                            <div class="col-12">
                                <h1 class="text-center" style="color: rgb(242,245,248);font-size: 56px;font-weight: bold;font-family: Roboto, sans-serif;margin-bottom: 59px;">ACOMPANHE NOSSO DESENVOLVIMENTO</h1>
                            </div>
                            <div class="col-4 offset-2">
                                <h1 class="d-xl-flex justify-content-xl-center" style="color: rgb(255,255,255);">20</h1>
                                <p class="d-xl-flex justify-content-xl-center" style="color: rgb(255,255,255);">CLIENTES</p>
                            </div>
                            <div class="col-4">
                                <h1 class="d-xl-flex justify-content-xl-center" style="color: rgb(255,255,255);">3</h1>
                                <p class="d-xl-flex justify-content-xl-center" style="color: rgb(255,255,255);">ESTADOS ATIVOS</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="team-boxed" id="depoimentos">
        <div class="container">
            <div class="intro">
                <h2 class="text-center">DEPOIMENTOS</h2>
            </div>
            <div class="row people">
                <div class="col-md-6 col-lg-4 item">
                    <div class="box"><img class="rounded-circle" src="{{asset('assets/site/img/2.jpg')}}">
                        <h3 class="name">Dra. Ana Karoline Silva Sousa</h3>
                        <p class="title">Direito Trabalhista</p>
                        <p class="description">Aenean tortor est, vulputate quis leo in, vehicula rhoncus lacus. Praesent aliquam in tellus eu gravida. Aliquam varius finibus est, et interdum justo suscipit id. Etiam dictum feugiat tellus, a semper massa. </p>
                        <div class="social"><a href="#"><i class="fa fa-facebook-official"></i></a><a href="#"><i class="fa fa-twitter"></i></a><a href="#"><i class="fa fa-instagram"></i></a></div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 item">
                    <div class="box"><img class="rounded-circle" src="{{asset('assets/site/img/2.jpg')}}">
                        <h3 class="name">Dra. Emily Clark</h3>
                        <p class="title">Direito Cívil</p>
                        <p class="description">Aenean tortor est, vulputate quis leo in, vehicula rhoncus lacus. Praesent aliquam in tellus eu gravida. Aliquam varius finibus est, et interdum justo suscipit id. Etiam dictum feugiat tellus, a semper massa. </p>
                        <div class="social"><a href="#"><i class="fa fa-facebook-official"></i></a><a href="#"><i class="fa fa-twitter"></i></a><a href="#"><i class="fa fa-instagram"></i></a></div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 item">
                    <div class="box"><img class="rounded-circle" src="{{asset('assets/site/img/3.jpg')}}">
                        <h3 class="name">Dr. Carl Kent</h3>
                        <p class="title">Direito Penal</p>
                        <p class="description">Aenean tortor est, vulputate quis leo in, vehicula rhoncus lacus. Praesent aliquam in tellus eu gravida. Aliquam varius finibus est, et interdum justo suscipit id. Etiam dictum feugiat tellus, a semper massa. </p>
                        <div class="social"><a href="#"><i class="fa fa-facebook-official"></i></a><a href="#"><i class="fa fa-twitter"></i></a><a href="#"><i class="fa fa-instagram"></i></a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="features-boxed">
        <div class="container" id="preco">
            <div data-aos="fade" class="intro">
                <h2 class="text-center" data-aos="fade" style="padding-top: 100px;">CONHEÇA NOSSOS PLANOS</h2>
                <hr style="width: 197px;border-top: 1px solid;">
            </div>
            <div class="row justify-content-center features">
                @forelse($assinaturas as $assinatura)
                    <div class="col-sm-6 col-md-5 col-lg-4 item">
                        <div data-aos="fade-up" data-aos-delay="100" class="box planos">
                            <h1 class="name" style="font-size: 52px;">R$ @php echo number_format($assinatura->valor,2,",","."); @endphp</h1>
                            <div class="table-responsive" style="font-family: 'Source Sans Pro', sans-serif;font-weight: normal;color: 999;font-size: 20px;">
                                <table class="table">
                                    <thead style="font-family: 'Unica One', cursive;">
                                        <tr>
                                            <th>{!! $assinatura->tipo !!}</th>
                                        </tr>
                                    </thead>
                                </table>
                              {!! $assinatura->descricao_site !!}
                            </div><a class="learn-more" href="{{route('register')}}" style="font-size: 18PX;">EXPERIMENTE GRÁTIS POR 10 DIAS</a></div>
                    </div>
                    @empty
                    <div class="col-sm-6 col-md-5 col-lg-4 item">
                        <div data-aos="fade-up" data-aos-delay="100" class="box planos">
                            <h1 class="name" style="font-size: 52px;">Em breve</h1>
                            <div class="table-responsive" style="font-family: 'Source Sans Pro', sans-serif;font-weight: normal;color: 999;font-size: 20px;">
                                <table class="table">
                                    <thead style="font-family: 'Unica One', cursive;">
                                        <tr>
                                            <th>Nenhum plano ativo no momento</th>
                                        </tr>
                                    </thead>
                                    <table>
                                        <th>Logo estaremos com várias promoções, aguardamos por você.</th>
                                    </table>
                                </table>
                            </div><a class="learn-more" href="{{route('register')}}" style="font-size: 18PX;">EXPERIMENTE GRÁTIS POR 10 DIAS</a>
                           </div>
                    </div>
                    @endforelse
            </div>
        </div>
    </div>
    <div class="register-photo" id="contato">
        <div class="form-container">
            <div class="image-holder"></div>
            <form method="post">
                <h2 class="text-center" style="margin: 0;"><strong>CONTATO</strong></h2>
                <p style="font-size: 12PX;">Quer saber mais sobre nossos planos ou tem dúvida sobre nossas funcionalidades? Entre em contato.<br></p>
                <div class="form-group"><input class="form-control" type="email" name="Nome" placeholder="Nome"></div>
                <div class="form-group"><input class="form-control" type="password" name="Email" placeholder="E-mail"></div><textarea class="form-control" placeholder="Mensagem"></textarea>
                <div class="form-group"><button style="background-color:#4c1982;" class="btn btn-primary btn-block" type="submit">Enviar mensagem</button></div>
            </form>
        </div>
    </div>
    <div class="footer-basic">
        <footer>
            <div class="social">
                <a href="#"><i class="icon ion-social-instagram"></i></a>
                <a href="#"><i class="icon ion-social-facebook"></i></a>
            </div>
            <p class="copyright">Copyright © @php echo date('Y'); @endphp GuiaADV.</a><br></p>
        </footer>
    </div>
    <script src="{{asset('assets/site/js/jquery.min.js')}}"></script>
    <script src="{{asset('assets/site/bootstrap/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('assets/site/js/bs-animation.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.1.1/aos.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jarallax/1.7.3/jarallax.min.js"></script>
</body>

</html>