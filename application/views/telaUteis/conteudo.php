<div class="container">

      <div class="content">
        <div class="page-header">
          <ul class="pills">
            <li><a href="#">Home</a></li>
            <li><a href="#">Profile</a></li>
            <li><a href="#">Messages</a></li>
            <li><a href="#">Settings</a></li>
            <li><a href="#">Contact</a></li>
          </ul>
        </div>
        <div class="row">
          <div class="col-md-4">
           <?php
                echo PainelUtil::getOpenPainel("Menu", PainelUtil::PAINEL_INFO);
                echo PainelUtil::getClosePainel();
           ?>
          </div>
          <div class="col-md-">
            <h3>Secondary content</h3>
          </div>
        </div>
      </div>