
        <div class="wrapper">
            <div class="page-header clear-filter">
                <div class="page-header-image" data-parallax="true" style="background-image:url('V/_template/assets/img/header.jpg');"></div>
                
                    <div class="row" style="margin-top:125px">
                    <div id="answer2" style="position:absolute;top:250px;z-index:5;left:40%"></div>
                        <div class="col-lg-12">
                            <div class="container">
                                <ul class="list-inline" style="height:45px">
                                    <li class="list-inline-item">
                                        <form id="prevForm" method="POST" action="index.php?page=calendar&&ym=<?= $prev; ?>">
                                            <button type="submit" id="prev" onclick="event.preventDefault();slidercss(this.id);" class="btn btn-link">&lt; Mois précèdent</button>
                                        </form>
                                    </li>
                                    <li class="list-inline-item"><div class="container" style="width:400px;height:45px"><span class="title"><?= $title; ?></span><a href="index.php?page=calendar" class="btn btn-link">Mois actuel</a></div></li>
                                    <li class="list-inline-item">
                                        <form id="nextForm" method="POST" action="index.php?page=calendar&&ym=<?= $next; ?>">
                                            <button type="submit" id="next" onclick="event.preventDefault();slidercss(this.id);" class="btn btn-link">Mois suivant &gt;</button>
                                        </form>    
                                    <li class="list-inline-item"></li>
                                </ul>
                            </div>
                        </div>
                    </div>
            
                    <div class="content-center-brand" >
                        <div class="bd-example">
                        <table class="table table-dark table-striped animated" id="calTable" style="margin:auto;max-width:1200px">
                            <thead>
                                <tr style="">
                                    <th scope="col" style="">Lundi</th>
                                    <th scope="col" style="">Mardi</th>
                                    <th scope="col" style="">Mercredi</th>
                                    <th scope="col" style="">Jeudi</th>
                                    <th scope="col" style="">Vendredi</th>
                                    <th scope="col" style="" data-toggle="tooltip" data-placement="top" title="CI LI">Samedi</th>
                                    <th scope="col" style="" data-toggle="tooltip" data-placement="top" title="WIK AND">Dimanche</th>
                                </tr>
                            </thead>
                            <tbody style="width:900px">
                                <?php
                                    foreach ($weeks as $week) {
                                        echo $week;
                                    }
                                ?>
                            </tbody>
                        </table>
                        </div>
                    </div>
            </div>
        </div> 
   

