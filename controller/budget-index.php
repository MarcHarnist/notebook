<?php
/**     budget-index.php
*
*   Auteur: Marc L. Harnist
*   Date: 2017
*   Mise à jour: 03/08/2018
*   marcharnist.fr/controller/budget-index.php
*
*   Index du budget
*   Après avoir supprimé les fichiers rendus inutiles par
*   le beau travail de l'échéancier (budget-echeancier),
*   il faudrait déplacer le php de l'échéancier vers le 
*   repertoire "controller" et utiliser foreach plutôt que
*   while. Régler aussi la date dans l'échéancier et les
*   checkboxes pour cocher ce qui est payé afin que cela
*   n'entre plus dans les calculs.
*
*   Accès réservé au niveau 1 (webmaster - cf: classe Website)
*/  $website->membersPermissions(1, $member);