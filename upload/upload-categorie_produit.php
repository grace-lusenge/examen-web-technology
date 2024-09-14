<?php
    include('connexion.php');
    $conn = new Connexion();
    $con = $conn->get_connexion();
    if(isset($_POST['description'])){
        $description = $_POST['description'];
        $idUp = $_POST['idUp'];
        if(empty($idUp)){
            $req = $con->prepare("INSERT INTO categorie_produit(description) VALUES(?)");
            if($req->execute([$description])){
                header('Location:../views/categorie-produit.php?msg=Enregistrement effectuer avec succès&status=success');
            }
            else{
                header("Location:../views/categorie-produit.php?msg=Echec d'enregistrement&status=error");
                
            }
        }
        else{
            $req = $con->prepare("UPDATE categorie_produit SET description = ? WHERE id = ?");
            if($req->execute([$description,$idUp])){
                header('Location:../views/categorie-produit.php?msg=La modification effectuer avec succès&status=success');
            }
            else{
                header("Location:../views/categorie-produit.php?msg=Echec d'enregistrement&status=error");
            }
        }

    }
    else if(isset($_POST['idDel'])){
        $idDel = $_POST['idDel'];
        $req = $con->prepare("DELETE FROM categorie_produit WHERE id = ?");
            if($req->execute([$idDel])){
                header('Location:../views/categorie-produit.php?msg=Suppression effectuer avec succès&status=success');
            }
            else{
                header("Location:../views/categorie-produit.php?msg=Echec de suppression&status=error");
            }

    }
    else{
        echo 'Erreur';
    }
    
?>