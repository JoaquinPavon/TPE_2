<?php 


class ApiComentariosModel {
    private $db;
    
    public function __construct() {
    $this->db = new PDO('mysql:host=localhost;'.'dbname=tpe_especial;charset=utf8', 'root', '');}



/* COMENTARIOS */
function insertComment($comentario,$ID_Juego){
    $query = $this->db->prepare("INSERT INTO comentarios (comentario, ID_Juego) VALUES (?, ?)");
    $query->execute(array($comentario,$ID_Juego));
    return $this->db->lastInsertId();}

function deleteComment($id){
    $query = $this->db->prepare("DELETE FROM comentarios WHERE comentarios.id= ?");
    $query->execute(array($id));}
        
    
function getComentario($id){
    $query = $this->db->prepare( "SELECT * FROM comentarios WHERE id = ? ");
    $query->execute(array($id));
    $comment = $query->fetchAll(PDO::FETCH_OBJ);
    return $comment;}
    
function getComentariosGame($id){
    $query = $this->db->prepare( "SELECT * FROM comentarios WHERE ID_Juego = ?");
    $query->execute(array($id));
    $comments = $query->fetchAll(PDO::FETCH_OBJ);
    return $comments;}
    
function getAll(){
    $query = $this->db->prepare("SELECT * FROM comentarios ORDER BY ID_JUEGO ASC");
    $query->execute();
    return $query->fetchAll(PDO::FETCH_OBJ);
    }
}