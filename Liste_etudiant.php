<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Liste étudiants</title>
    <link rel="stylesheet" href="assets/style_liste.css">
    <link rel="shortcut icon" href="Image/logo.png"/>
    <script src="script/liste_etudiant.js"></script>
    <script src="script/jquery.min.js"></script>
</head>
<body>
    <header>
        <?php include 'header.php'; ?>
    </header>

    <div class="search-container">
        <input type="text" id="nom" placeholder="Nom" class="search-input">
        <input type="text" id="prenom" placeholder="Prénom" class="search-input">
        <div class="selection-container">
            <label for="promotion" class="select-label">Sélectionnez une promotion :</label>
            <select id="promotion" class="select-input">
            <?php
                require 'connexion_bdd/creation_connexion.php';

                $requete = "SELECT DISTINCT nom_promotion, specialite FROM promotion";
                $result = $dbh->query($requete);

                while ($colonne = $result->fetch(PDO::FETCH_ASSOC)) {
                    echo "<option>" . htmlspecialchars($colonne['nom_promotion'], ENT_QUOTES, 'UTF-8') . " " . htmlspecialchars($colonne['specialite'], ENT_QUOTES, 'UTF-8') . "</option>";
                }
            ?>
            </select>
        </div>
        <button onclick="rechercher()" class="search-button">Rechercher</button>
    </div>

    <?php
        require 'connexion_bdd/creation_connexion.php';

        $page = isset($_GET['page']) ? $_GET['page'] : 1;
        $studentsPerPage = 3; 

        $nom = isset($_GET['nom']) ? $_GET['nom'] : '';
        $prenom = isset($_GET['prenom']) ? $_GET['prenom'] : '';
        $promotion = isset($_GET['promotion']) ? $_GET['promotion'] : '';

        if (isset($_SESSION['id_compte'])) {
            $id_compte = $_SESSION['id_compte'];
        }

        
        $sql = "SELECT 
                    E.id_etudiant, 
                    E.nom, 
                    E.prenom, 
                    C.email_pro, 
                    P.nom_promotion, 
                    P.specialite, 
                    Ce.nom_centre, 
                    GROUP_CONCAT(Co.nom_competence SEPARATOR ', ') AS competences_acquises 
                FROM 
                    Etudiant E 
                JOIN 
                    Compte C ON E.id_compte = C.id_compte 
                LEFT JOIN 
                    Etudier Et ON E.id_etudiant = Et.id_etudiant 
                LEFT JOIN 
                    Promotion P ON Et.id_promotion = P.id_promotion 
                LEFT JOIN 
                    Centre Ce ON P.id_centre = Ce.id_centre 
                LEFT JOIN 
                    Acquerir A ON E.id_etudiant = A.id_etudiant 
                LEFT JOIN 
                    Competences Co ON A.id_competence = Co.id_competence 
                WHERE 
                    1=1";
        
        if (!empty($nom)) {
            $sql .= " AND E.nom LIKE :nom";
        }
        
        if (!empty($prenom)) {
            $sql .= " AND E.prenom LIKE :prenom";
        }
        
        if (!empty($promotion)) {
            $sql .= " AND P.nom_promotion = :promotion";
        }
        
        $sql .= " AND E.is_deleted = FALSE";
        $sql .= " GROUP BY E.id_etudiant, E.nom, E.prenom, C.email_pro, P.nom_promotion, P.specialite, Ce.nom_centre";

        $stmt = $dbh->prepare($sql);

        if (!empty($nom)) {
            $stmt->bindValue(':nom', "%$nom%");
        }
        
        if (!empty($prenom)) {
            $stmt->bindValue(':prenom', "%$prenom%");
        }
        
        if (!empty($promotion)) {
            $stmt->bindValue(':promotion', "$promotion");
        }

        $stmt->execute();

        $totalStudents = $stmt->rowCount();
        $totalPages = ceil($totalStudents / $studentsPerPage);

        $offset = ($page - 1) * $studentsPerPage;

        $sql .= " LIMIT :offset, :studentsPerPage";
        $stmt = $dbh->prepare($sql);

        if (!empty($nom)) {
            $stmt->bindValue(':nom', "%$nom%");
        }
        
        if (!empty($prenom)) {
            $stmt->bindValue(':prenom', "%$prenom%");
        }
        
        if (!empty($promotion)) {
            $stmt->bindValue(':promotion', $promotion);
        }
        
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->bindValue(':studentsPerPage', $studentsPerPage, PDO::PARAM_INT);

        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $index = 0;

        foreach ($result as $colonne) {
            echo '<div class="container">';
            echo '<div class="profile">';
            echo '<img src="Image/profil.png" alt="Profile Picture">';
            echo '<div class="info">';
            echo '<h2>' . htmlspecialchars($colonne['nom'], ENT_QUOTES, 'UTF-8') . ' ' . htmlspecialchars($colonne['prenom'], ENT_QUOTES, 'UTF-8') . '</h2>';
            echo '<p>' . htmlspecialchars($colonne['email_pro'], ENT_QUOTES, 'UTF-8') . '</p>';
            echo '</div></div>';
            echo '<div class="points-container" onclick="toggleDropdown(' . $index . ')">';
            echo '<div class="point"></div>';
            echo '<div class="point"></div>';
            echo '<div class="point"></div>';
            echo '</div>';

            $sqlRole = "SELECT
                            C.id_compte, 
                            CASE 
                                WHEN A.id_administrateur IS NOT NULL THEN 'Administrateur' 
                                WHEN E.id_etudiant IS NOT NULL THEN 'Etudiant' 
                                ELSE 'Autre' 
                            END AS role 
                        FROM 
                            Compte C 
                        LEFT JOIN 
                            Administrateur A ON C.id_compte = A.id_compte 
                        LEFT JOIN 
                            Etudiant E ON C.id_compte = E.id_compte 
                        WHERE 
                            C.id_compte = :id_compte";

            $stmtRole = $dbh->prepare($sqlRole);
            $stmtRole->bindParam(':id_compte', $id_compte, PDO::PARAM_INT);
            $stmtRole->execute();
            $resultsRole = $stmtRole->fetchAll(PDO::FETCH_ASSOC);

            foreach ($resultsRole as $row) {
                if ($row['role'] === 'Etudiant') {
                    echo '</div>';
                } else {
                    echo '<div class="dropdown-menu" id="dropdownMenu_' . $index . '">';
                    echo '<a href="#" class="update-link" data-id="' . htmlspecialchars($colonne['id_etudiant'], ENT_QUOTES, 'UTF-8') . '">Modifier</a>';
                    echo '<a href="#" class="delete-link" data-id="' . htmlspecialchars($colonne['id_etudiant'], ENT_QUOTES, 'UTF-8') . '">Supprimer</a>';
                    echo '</div></div>';
                    $index++;
                }
            }
        }
    ?>

    <div id="pagination" class="pagination"></div>

    <?php include 'footer.php'; ?>

    <script type="text/javascript">
        function showPagination() {
            var totalPages = <?php echo $totalPages; ?>;
            var currentPage = <?php echo $page; ?>;
            var paginationContainer = document.getElementById('pagination');

            paginationContainer.innerHTML = '';

            for (var i = 1; i <= totalPages; i++) {
                var button = document.createElement('button');
                button.innerText = i;
                button.value = i;
                if (i === currentPage) {
                    button.classList.add('active');
                }
                button.addEventListener('click', function () {
                    showStudents(this.value);
                });
                paginationContainer.appendChild(button);
            }
        }
        showPagination();

        $(document).ready(function() {
            $('.delete-link').click(function(e) {
                e.preventDefault(); 
                var idEtudiant = $(this).data('id');
                window.location.href = 'Supprimer_etudiant.php?id=' + idEtudiant;
            });

            $('.update-link').click(function(e) {
                e.preventDefault(); 
                var idEtudiant = $(this).data('id');
                window.location.href = 'Modifier_etudiant.php?id=' + idEtudiant;
            });
        });
    </script>
</body>
</html>