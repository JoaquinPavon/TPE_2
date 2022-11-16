<?php

class ApiModel {
private $db;

public function __construct() {
$this->db = new PDO('mysql:host=localhost;'.'dbname=tpe_especial;charset=utf8', 'root', '');}

function InsertGame ($nombre,$fecha,$precio,$Descripcion,$genero) {
$query = $this->db->prepare('INSERT INTO juegos (Nombre,Fecha,Precio,Descripcion,Genero_ID) VALUES (?,?,?,?,?)');
$query->execute([$nombre,$fecha,$precio,$Descripcion,$genero]);
return $this->db->lastInsertId();}

function DeleteGameByID ($ID_Juego) {
$query = $this->db->prepare('DELETE FROM juegos WHERE ID_Juego = ?');
$query->execute([$ID_Juego]);}

function getGame($ID_Juego){
$query = $this->db->prepare( "SELECT juegos.ID_Juego, juegos.Nombre, juegos.Fecha, juegos.Precio, juegos.Descripcion, juegos.Genero_ID, generos.Genero FROM juegos JOIN generos ON juegos.Genero_ID = generos.Genero_ID WHERE ID_Juego=?;");
$query->execute(array($ID_Juego));
$game = $query->fetch(PDO::FETCH_OBJ);
return $game;}

function UpdateGameBD($ID_Juego,$Nombre,$Fecha,$Precio,$Descripcion,$Genero){
$query = $this->db->prepare("UPDATE juegos SET Nombre=?,Fecha=?,Precio=?,Descripcion=?,Genero_ID=? WHERE ID_Juego =?");
$query->execute(array($Nombre,$Fecha,$Precio,$Descripcion,$Genero,$ID_Juego));}


function valueSort($sort=null){
$query = $this->db->prepare("SELECT * FROM INFORMATION_SCHEMA.COLUMNS WHERE COLUMN_NAME = ? AND TABLE_NAME = 'juegos'");
$query->execute(array($sort));
$columna = $query->fetchAll(PDO::FETCH_OBJ);
return count($columna);}

function getAllGames(){    
$query = $this->db->prepare( "SELECT juegos.*, generos.Edad, generos.Genero  FROM juegos JOIN generos ON juegos.Genero_ID = generos.Genero_ID ORDER BY ID_Juego"); 
$query->execute();
$games = $query->fetchAll(PDO::FETCH_OBJ);
return $games;}  


function AllParameters($sort,$order,$page,$limit,$filter){
$offset = (($page - 1) * $limit);    
$query = $this->db->prepare( "SELECT juegos.*, generos.Edad, generos.Genero FROM juegos JOIN generos ON juegos.Genero_ID = generos.Genero_ID WHERE juegos.Genero_ID = $filter ORDER BY $sort $order  LIMIT "  .$offset ." , ".$limit);
$query->execute();
$games = $query->fetchAll(PDO::FETCH_OBJ);
return $games;}

function PaginatedSortedByColumn ($sort,$order,$page,$limit) {
$offset = (($page - 1) * $limit);    
$query = $this->db->prepare( "SELECT juegos.*, generos.Edad, generos.Genero FROM juegos JOIN generos ON juegos.Genero_ID = generos.Genero_ID ORDER BY $sort $order  LIMIT "  .$offset ." , ".$limit);
$query->execute();
$games = $query->fetchAll(PDO::FETCH_OBJ);
return $games;}

function OrderSortedAndFiltered ($sort,$order,$filter){
$query = $this->db->prepare( "SELECT juegos.*, generos.Edad, generos.Genero FROM juegos JOIN generos ON juegos.Genero_ID = generos.Genero_ID WHERE juegos.Genero_ID = $filter ORDER BY $sort $order");
$query->execute();
$games = $query->fetchAll(PDO::FETCH_OBJ);
    return $games; 
}

function PaginatedAndFiltered ($page,$limit,$filter){
$offset = (($page - 1) * $limit);     
$query = $this->db->prepare("SELECT juegos.*, generos.* FROM juegos JOIN generos ON juegos.Genero_ID = generos.Genero_ID WHERE generos.Genero_ID = $filter LIMIT "  .$offset ." , ".$limit);
$query->execute();
$games = $query->fetchAll(PDO::FETCH_OBJ);
return $games;
}

function SortedAndOrder($sort,$order){
$query = $this->db->prepare( "SELECT juegos.*,  generos.Edad, generos.Genero FROM juegos JOIN generos ON juegos.Genero_ID = generos.Genero_ID ORDER BY $sort $order");
$query->execute();
$games = $query->fetchAll(PDO::FETCH_OBJ);
return $games; 
}


function Paginated ($page,$limit){
$offset = (($page - 1) * $limit); 
$query = $this->db->prepare("SELECT juegos.*, generos.Edad, generos.Genero FROM juegos JOIN generos ON juegos.Genero_ID = generos.Genero_ID ORDER BY ID_Juego  LIMIT "  .$offset ." , ".$limit);
$query->execute();
$games = $query->fetchAll(PDO::FETCH_OBJ);
return $games; 
}

function filter($filter){
$query = $this->db->prepare("SELECT * FROM juegos WHERE Genero_ID = ?");
$query->execute([$filter]);
$games = $query->fetchAll(PDO::FETCH_OBJ);
return $games;}
































/* COMENTARIOS */
function insertComment($comentario,$ID_Juego){
$sentencia = $this->db->prepare("INSERT INTO comentarios (comentario, ID_Juego) VALUES (?, ?)");
$sentencia->execute(array($comentario,$ID_Juego));
return $this->db->lastInsertId();}

function getComentario($id){
$sentencia = $this->db->prepare( "SELECT * FROM comentarios WHERE id = ? ");
$sentencia->execute(array($id));
$comment = $sentencia->fetchAll(PDO::FETCH_OBJ);
return $comment;}

function getComentariosGame($id){
$sentencia = $this->db->prepare( "SELECT * FROM comentarios WHERE ID_Juego = ?");
$sentencia->execute(array($id));
$comments = $sentencia->fetchAll(PDO::FETCH_OBJ);
return $comments;}

function deleteComment($id){
$sentencia = $this->db->prepare("DELETE FROM comentarios WHERE comentarios.id= ?");
$sentencia->execute(array($id));}


function getComentarioLibroDesc($id){
$sentencia = $this->db->prepare( "SELECT * FROM comentarios WHERE ID_Juego = ?");
$sentencia->execute(array($id));
$commet = $sentencia->fetchAll(PDO::FETCH_OBJ);
return $commet;}

function getAll($sortBy = null, $order = null){
if (isset($sortBy) && isset($order)) {
$req = $this->db->prepare("SELECT * FROM comentarios ORDER BY $sortBy $order");
$req->execute();} 
else {
$req = $this->db->prepare('SELECT * FROM comentarios');
$req->execute();}
return $req->fetchAll(PDO::FETCH_OBJ);
}

function getComentarioLibro($order=null,$page=null,$limit=null){
if(!empty($order)&&!empty($page)&&!empty($limit)&&$page!=null && $limit!=null){
    $sentencia = $this->db->prepare("SELECT * FROM comentarios ORDER BY ID_Juego ".$order ." LIMIT ".$page .",".$limit);
}else if(!empty($order)){
    $sentencia = $this->db->prepare("SELECT * FROM comentarios ORDER BY ID_Juego ".$order);

} else{
$sentencia = $this->db->prepare( "SELECT * FROM comentarios ORDER BY ID_Juego" );
} 
$sentencia->execute();
$commet = $sentencia->fetchAll(PDO::FETCH_OBJ);
return $commet;
}


    

}


