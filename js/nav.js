          /* Quand l'utilisateur clique sur le bouton l'interrupteur montre ou cache le dropdown */
          function myFunction() {
            var drop = document.getElementById("myDropdown");
            drop.classList.toggle("show");
            
          }
          var btn = document.getElementById('myDropdown');
          if(btn!=null) {
            btn.addEventListener('click', (e) => {
              e.target;
              drop.classList.toggle("show");
            })
          }
          /* Fermer le dropdown si l'utilisateur clique en dehors du drop */
          window.onclick = function(e) {
            if (!e.target.matches('.dropbtn')) {
            var myDropdown = document.getElementById("myDropdown");
              if (myDropdown.classList.contains('show')) {
                myDropdown.classList.remove('show');
              }
        
            } 
          }