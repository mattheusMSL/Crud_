<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors',1);
    error_reporting(E_ALL);

    require_once __DIR__."/../repository/Usuariorepository.php";

    $usuario = new Usuariocontroller();
    
    class Usuariocontroller{
        function __construct(){
            if(isset($_POST["action"])){
                $action = $_POST["action"];
            }elseif(isset($_GET["action"])){
                $action=$_GET["action"];
            }
            if(isset($action)){
                $this->callAction($action);
            }else{
                $msg="NENHUMA ACAO ENCONTRADA";
                print_r($msg);

            }
            
        }

        public function callAction(String $functionName){
            if(method_exists($this,$functionName)){
                $this->$functionName;
            }else if(method_exists($this,"preventDefault")){
                $met = "preventDefault";
                $this->$met;
            }else{
                throw new BadFunctionCallException("usecase not exists");
            }
        }

        public function loadView(string $path, array $data =null, string $msg = null){
        $caminho= __DIR__. "/../views/".$path;
        if(file_exists($caminho)){
            require $caminho;
        }else{
            print("Erro ao carregar views");
        }
    }

    private function criar(){
        $usuario = new Usuariomodels();
        $usuario->setNome($_POST["nome"]);
        $usuario->setEmail($_POST["email"]);
        $usuario->setSenha($_POST["senha"]);

        $Usuariorepository = new UsuarioRepository();

        $id = $Usuariorepository->criar($usuario);

        if($id){
            $msg ="REGISTRO INSERIDO COM SUCESSO!";
        }else{
            $msg="ERRO AO INSERIR O REGISTRO NO BANCO DE DADOS";
        }
        $this->findAll($msg);
    }
    private function loadForm(){
        $this->loadView("views/Usuarios/Usuariocadastro.php", null, "teste");
    }

    private function findAll(string $msg = null){
        $Usuariorepository= new UsuarioRepository();
        $usuario = $Usuariorepository->findAll();

        $data['titulo']= "listar Usuarios";
        $data['usuarios'] = $usuario; 

        $this-> loadView("Usuarios/Usuariolista.php",$data,$msg);

    }
    private function FindUsuarioById(){
        $idParam = $_GET('id');
        $Usuariorepository = new UsuarioRepository();
        $usuario = $Usuariorepository->findUsuarioById($idParam);
        print "<prev>";
        print ($usuario);
        print"prev";
    }

    private function DeletarUsuarioById(){
        $idParam = $_GET('id');
        $Usuariorepository = new UsuarioRepository();
        $dt= $Usuariorepository -> DeleteById($idParam);
        if($dt){
            $msg = "REGISTRO EXCLUÍDO COM SUCESSO";
        }else{
            $msg = "FALHA AO EXCLUIX REGISTRO!";
        }
        $this->findAll($msg);
    }
     
    private function editarUsuario(){
        $idParam = $_GET('id');
        $Usuariorepository = new UsuarioRepository();
        $usuario= $Usuariorepository-> findUsuarioById($idParam);
        $data['usuario'][0] = $usuario;

        $this->loadView("Usuarios/Usuariolista.php", $data);
    }

    private function atualizarUsuario(){
        $usuario = new Usuariomodels();
        $usuario -> setId($_GET["id"]);
        $usuario-> setNome($_POST["nome"]);
        $usuario->setEmail($_POST["email"]);
        $usuario-> setSenha($_POST["senha"]);

        $Usuariorepository = new UsuarioRepository();
        $atualizar = $Usuariorepository->atualizar($usuario);
        if($atualizar){
            $msg= "REGISTRO ATUALIZADO COM SUCESSO!";
        }else{
            $msg = "ERRO AO ATUALIZAR REGISTRO!";
        }
        $this->findAll($msg);
    }
private function preventDefault(){
    print "AÇÃO INDEFINIDA...";
   }   

    
}