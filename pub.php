<?php require "inc/includes.php"; ?>
    <?php require "inc/functions.php";?>
    <?php logged_only();  ?>
    <?php require 'inc/header.php';  ?>
    <style>
        @import "css/style_connexion.css";
        .connect {
            margin-bottom: 40px;
        }
        .go {
            display: flex;
            justify-content: center;
            margin-bottom: 20px;
        }
        .go input {
            width: 20px;
            margin: 0px 5px;
        }
    </style>

<div class="container">
        <div class="connect"><label>Publier une enchère</label> </div>
        <span>
            <form action="post.php" method="post" enctype="multipart/form-data">
                <p class="go"><input type="checkbox" name="go" id="go"><label for="go">Je publie plusieurs articles</label></p>
                
                <input name="chImage" id="chImage" type="file" hidden="hidden" required>
                <input placeholder="Nom de l'article" name="libel" type="text" required>
                
                <input placeholder="Prix de départ de l'article" name="startPrice" type="text" required>
                <input placeholder="Date de séjour de l'article" name="endDate" type="date" required>
                <input placeholder="Heure de séjour de l'article" name="endTime" type="time" required>
                <textarea style="outline:none;border-radius:8px;padding:10px;" rows="5"  name="description" placeholder="Description de l'article"></textarea>
                <button type="submit" name="end">Publier l'article</button>
            </form>    
        </span>
</div>

    <?php require 'inc/footer.php';  ?>
