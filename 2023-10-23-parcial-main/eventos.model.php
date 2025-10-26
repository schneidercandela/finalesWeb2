<?php

class EventosModel {

    public function getById($id) {
        $db = new PDO('mysql:dbname=test;host=localhost', 'root', '');
        
        $query = $db->prepare("SELECT precio FROM evento WHERE id = ?");
        $query->execute([$id]);

        return $query->fetch(PDO::FETCH_OBJ);
    }
}