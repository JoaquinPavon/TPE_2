<?php
require_once './app/views/api-view.php';
require_once './app/models/Api-Comentarios-Model.php';
require_once './app/controllers/Auth-Api-Controller.php';
class ApiComentariosController {




    public function __construct() {
        $this->model = new ApiModel();
        $this->view = new ApiView();
        $this->authHelper = new AuthHelper();
        $this->data = file_get_contents("php://input");
    }
     
        private function getData(){
        return json_decode($this->data);}





/* COMENTARIOS */
// Inserto comentario a un juego
function InsertComment($params = null){
    if(!$this->authHelper->isLoggedIn()){
    $this->view->response("No estas logeado, logeá para poder realizar esta accion", 401);
    return;}
    try { 
    $body = $this->getData();
    if (empty($body->comentario) || empty($body->ID_Juego) || !isset($body->comentario) || !isset ($body->ID_Juego)) {
    $this->view->response("Complete los datos", 400);} 
    else {
    $id = $this->model->insertComment($body->comentario, $body->ID_Juego);
    $this->view->response("El comentario se insertó con el id=$id", 201);}}
    catch (\Throwable $e) {
    $this->view->response("Error no encontrado, revise la documentacion", 500);}}
    
    // Elimino comentario de un juego
    function DeleteComment($params = null){
    if(!$this->authHelper->isLoggedIn()){
    $this->view->response("Necesitas loguearte para poder realizar esta accion", 401);
    return;}
    try {     
    $idComment = $params[':ID'];
    $idComment2 = $params[':comentarioID'];
    $comment = $this->model->getComentariosGame($idComment);
    $comment2 = $this->model->getComentario($idComment2);
    if (!empty($comment) && !empty($comment2) && isset($comment) && isset($comment2)) {
    $this->model->deleteComment($idComment2);
    $this->view->response("El comentario con la id = $idComment2 fue borrado del juego con la ID: $idComment", 200);} 
    else {
    return $this->view->response("El comentario con ID = $idComment2 no fue borrada, no existe o no hay ningun comentario con esa ID", 404);}}
    catch (\Throwable $e) {
    $this->view->response("Error no encontrado, revise la documentacion", 500);}}
    
    // Traigo un comentario especifico por ID.
    function getComment($params = null){
    try{ 
    $id = $params[':ID'];
    $comment = $this->model->getComentario($id);
    if ($comment)
    $this->view->response($comment);
    else
    $this->view->response("El comentario con el id $id no existe.", 404);}
    catch (\Throwable $e) {
    $this->view->response("Error no encontrado, revise la documentacion", 500);}}
    
    
    // Traigo todos los comentarios de un juego
    function getGameComments($params = null){
    try {    
    $id = $params[':ID'];
    $comment = $this->model->getComentariosGame($id);
    if ($comment) {
    $this->view->response($comment);} 
    else {
    $this->view->response("El juego con el id $id no tiene comentarios.", 404);}}
    catch (\Throwable $e) {
    $this->view->response("Error no encontrado, revise la documentacion", 500);}}
    
    function getComments($params = null){
    try { 
    $comments = $this->model->getALL();
    if(!empty($comments)){
    $this->view->response($comments,200);}
    else {
    $this->view->response("No existen ningun comentario", 404);}}
    catch (\Throwable $e) {
    $this->view->response("Error no encontrado, revise la documentacion", 500);}
    }
    
    













}