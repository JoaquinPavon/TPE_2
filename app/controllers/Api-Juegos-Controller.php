<?php
require_once './app/models/Api-Juegos-Model.php';
require_once './app/views/api-view.php';

class ApiController
{
    private $model;
    private $view;
    private $data;



public function __construct() {
$this->model = new ApiModel();
$this->view = new ApiView();
$this->authHelper = new AuthHelper();

$this->data = file_get_contents("php://input");}

private function getData(){
return json_decode($this->data);}

/* JUEGOS  */

function getApiGames(){
    $sort = $_GET['sort'] ?? null;
    $order = $_GET['orderby'] ?? null;
    $page = $_GET['page'] ?? null;
    $limit = $_GET['limit'] ?? null;
    $filter = $_GET['filter'] ?? null;
   
    try {
    if(!empty($_GET['orderby'])){
        if($_GET['orderby'] == "DESC"|| $_GET['orderby']  == "desc" || $_GET['orderby']  == "ASC"|| $_GET['orderby']  == "asc"){
        }else{
        return $this->view->response("OrderBY mal escrito, prueba escribiendo ASC/asc/DESC/desc o revise la documentacion",400);}}
    if(!empty($_GET['sort'])){
        $valueSort = $this->model->valueSort($_GET['sort']);
        if( $valueSort == 0){
        return $this->view->response("La columna no existe, por favor revise la documentacion",400);}}
    if(!empty($_GET['limit']) && !is_numeric($_GET['limit'])){
        return $this->view->response("El limit no puede ser un STRING. Revise la documentacion", 400);}
    if(!empty($_GET['filter']) && !is_numeric($_GET['filter'])){
        $this->view->response("No se puede colocar un STRING en el filtrado, revise la documentacion", 400);} // TODAS LAS VALIDACIONES DE URL
// Todos los parametros
    if(!empty($_GET['sort']) && !empty($_GET['limit']) && !empty($_GET['filter']) &&!empty($_GET['orderby'])){
    if(isset($_GET['sort']) && isset($_GET['limit']) && isset($_GET['filter']) && isset($_GET['orderby']) && isset($_GET['page'])){
        if(!empty($_GET['page']==0) || !is_numeric($_GET['page'])){
            return $this->view->response("La pagina no puede ser 0, ni ser un STRING. Revise la documentacion",400);}
        $games = $this->model->AllParameters($sort,$order,$page,$limit,$filter); 
        if (empty($games)){
        $this->view->response("El arreglo esta VACIO a causa de una mala ID, revise la documentacion", 400);}}}
// Paginacion mas ordenado
    else if (!empty($_GET['orderby']) && isset($_GET['page']) && !empty($_GET['limit']) && !empty($_GET['sort'])) {
        if (isset($_GET['orderby']) && isset($_GET['limit']) && isset($_GET['sort'])) {
                if (!empty($_GET['page'] == 0) || !is_numeric($_GET['page'])) {
                    return $this->view->response("Page no puede ser 0 ni un STRING, revise la documentacion", 400); }        
        $games = $this->model->PaginatedSortedByColumn($sort, $order, $page, $limit);
        if (empty($games)){
            $this->view->response("El arreglo esta VACIO a causa de un valor de parametro invalido, revise la documentacion", 400);}}}
// Ordenado y por columna y filtrado
    else if (!empty($_GET['orderby']) && !empty($_GET['sort']) && isset($_GET['orderby']) && isset($_GET['sort']) && isset($_GET['filter']) && !empty($_GET['filter']) ) {
        $games = $this->model->OrderSortedAndFiltered($sort, $order, $filter);
        if (empty($games)){
            $this->view->response("El arreglo esta VACIO a causa de una mala ID en el filtrado, revise la documentacion", 400);}}
// Paginado y filtrado
    else if (isset($_GET['page']) && isset($_GET['limit']) && isset($_GET['filter']) && !empty($_GET['filter']) && !empty($_GET['limit'])) {
        if(!empty($_GET['page']==0) || !is_numeric($_GET['page'])){
            return $this->view->response("Page no puede ser 0 ni un STRING, revise la documentacion",400);}
        $games = $this->model->PaginatedAndFiltered($page,$limit,$filter);
        if (empty($games)){
            $this->view->response("El arreglo esta VACIO a causa de un valor de parametro invalido, revise la documentacion", 400);}}
// Paginado
    else if (isset($_GET['page']) && (!empty($_GET['limit'])) && isset($_GET['limit'])) {
        if(!empty($_GET['page']==0) || !is_numeric($_GET['page'])){
            return $this->view->response("Page no puede ser 0 ni un STRING, revise la documentacion",400);}
        $games = $this->model->Paginated($page,$limit);
        if (empty($games)){
            $this->view->response("El arreglo esta VACIO a causa de una mala ID", 400);}}
// Ordenado y por columna
    else if (isset($_GET['orderby']) && isset ($_GET['sort']) && !empty($_GET['orderby']) && !empty($_GET['sort'])){
       $games = $this->model->SortedAndOrder($sort,$order);}
// Filtrado
    else if (isset($_GET['filter']) && !empty($_GET['filter'])) {   
        $games = $this->model->filter($filter);
         if (empty($games)){
        $this->view->response("El arreglo esta VACIO a causa de una mala ID en el filtrado, revise la documentacion", 400);}}
    else {
        $games = $this->model->getAllGames();} 
        return $this->view->response($games,200);}

    catch (\Throwable $th) {
        $this->view->response("Error no encontrado, revise la documentacion", 500);}
}

//Traer un juego

function getApiGame ($params = null) { 
try {
$id = $params[':ID'];
$game = $this->model->getGame($id);
if ($game)
$this->view->response($game);
else
$this->view->response("El juego con el id $id no existe", 404);} 
catch (\Throwable $th) {
$this->view->response("Error no encontrado, revise la documentacion", 500);}}

// Elimino juego por su ID
public function deleteApiGame($params = null){
if(!$this->authHelper->isLoggedIn()){
$this->view->response("No estas logeado, logeá para poder realizar esta accion", 401);
return;}
try { 
$ID_Juego = $params[':ID'];
$game = $this->model->getGame($ID_Juego);
if ($game) {
$this->model->DeleteGameByID($ID_Juego);
$this->view->response("El juego con la id=$ID_Juego se eliminó", 200);} 
else{ 
$this->view->response("El juego con la id=$ID_Juego no existe", 404);}
}
catch (\Throwable $e) {
$this->view->response("El juego contiene comentarios, primero eliminelos para poder continuar", 404);}}


// Inserto juego
public function insertApiGame($params = null) {
if(!$this->authHelper->isLoggedIn()){
$this->view->response("No estas logeado, logeá para poder realizar esta accion", 401);
return;}
try { 
$game = $this->getData();
if (empty($game->Nombre) || empty($game->Fecha) || empty($game->Precio) || empty($game->Descripcion) || empty($game->Genero_ID)) {
if (!isset($game->Nombre) || !isset($game->Fecha) || !isset($game->Precio) || !isset($game->Descripcion) || !isset($game->Genero_ID)) {    
$this->view->response("Complete los datos", 400);} } 
else {
$id = $this->model->InsertGame($game->Nombre, $game->Fecha, $game->Precio, $game->Descripcion, $game->Genero_ID);
$games = $this->model->getGame($id);
if ($games) { 
$this->view->response("El juego se creó correctamente", 201);}}}
catch (\Throwable $e) {
$this->view->response("Error no encontrado", 500);}}


// Modifico Juego

public function UpdateApiGame($params = null){
if(!$this->authHelper->isLoggedIn()){
$this->view->response("No estas logeado, logeá para poder realizar esta accion", 401);
return;}
try { 
$ID_Juego = $params[':ID'];
$body = $this->getData();
$game = $this->model->getGame($ID_Juego);
if (empty($body->Nombre) || empty($body->Fecha) || empty($body->Precio) || empty($body->Descripcion) ||  empty($body->Genero_ID)) {
if (!isset($game->Nombre) || !isset($game->Fecha) || !isset($game->Precio) || !isset($game->Descripcion) || !isset($game->Genero_ID)) {  
$this->view->response("Complete todos los datos correctamente", 400);}} 
else {
$this->model->UpdateGameBD($ID_Juego, $body->Nombre, $body->Fecha, $body->Precio, $body->Descripcion, $body->Genero_ID);
$this->view->response("Se actualizo correctamente el juego con id $ID_Juego", 201);}} 
catch (\Throwable $e) {
$this->view->response("Error no encontrado, revise la documentacion", 500);}}


}
