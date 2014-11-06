<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <meta charset="utf-8"/>
        <title>Mentorship</title>
        <meta http-equiv="X-UA-Compatible" content="IE=Edge"> 
        <meta name="viewport" content="width=device-width, minimal-ui, initial-scale=1.0, user-scalable=0"/>
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="black">
        <meta name="description" content=""/>
        <meta name="author" content=""/>
        <!-- ICONS -->
        <link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url(); ?>assets/images/icon/icon-16.png"/>
        <link rel="apple-touch-icon" href="<?php echo base_url(); ?>assets/images/icon/icon-16.png">
        <link rel="apple-touch-icon-precomposed" sizes="57x57" href="<?php echo base_url(); ?>assets/images/icon/icon-57.png" />
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo base_url(); ?>assets/images/icon/icon-72.png" />
        <link rel="apple-touch-icon" sizes="76x76" href="<?php echo base_url(); ?>assets/images/icon/icon-76.png">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo base_url(); ?>assets/images/icon/icon-114.png" />
        <link rel="apple-touch-icon" sizes="120x120" href="<?php echo base_url(); ?>assets/images/icon/icon-120.png">
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo base_url(); ?>assets/images/icon/icon-144.png" />
        <link rel="apple-touch-icon" sizes="152x152" href="<?php echo base_url(); ?>assets/images/icon/icon-152.png">
        <link rel="apple-touch-startup-image" href="<?php echo base_url(); ?>assets/images/icon/icon-152.png">
        <!-- bootstrap css -->
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/bootstrap.min.css"/>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/login.css"/>
        <link rel="prefetch" type="application/l10n" href="<?php echo base_url(); ?>assets/data/locales.ini" />
    </head>
    <body>
        <main>
            <div id="login" class="text-center">
                <div class="row">
                    <div class="col-lg-12">
                        <img src="<?php echo base_url(); ?>assets/images/mozilla-brasil.png" />
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <button id="btn-request-mentor" class="btn btn-lg btn-danger">Solicitar Mentor</button>
                    </div>
                    <div class="col-lg-6">
                        <button id="btn-login-persona" class="btn btn-lg btn-primary">Login com Persona</button>
                    </div>
                </div>
            </div>
        </main>
        <div id="modal-request-mentor" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <h4 class="modal-title">Solicitar mentor</h4>
                    </div>
                    <div class="modal-body">
                        <table class="table table-bordered table-condensed table-hover table-responsive table-striped">
                            <thead>
                                <tr>
                                    <th class="text-left">Nome</th>
                                    <th class="text-center">Email</th>
                                    <th class="text-center">Cidade</th>
                                    <th class="text-center">UF</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (is_array($list_mentors)) {
                                    foreach ($list_mentors as $mentor) {
                                        $this->load->view('login/row_mentor', $mentor->serverData);
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
                        <!--<button type="button" class="btn btn-success" id="btn-submit-request">Solicitar mentoria</button>-->
                    </div>
                </div>
            </div>
        </div>
        <script type="text/javascript">
            var URL_BASE = '<?php echo base_url(); ?>';
        </script>
        <!--<script type="text/javascript" src="https://login.persona.org/include.js"></script>-->
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery/jquery.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/twitter-bootstrap/bootstrap.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/modernizr/modernizr.js"></script>
        <!--<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/l10n/l10n.js"></script>-->
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/require.js/require.js" data-main="<?php echo base_url(); ?>assets/js/login"></script>
    </body>
</html>