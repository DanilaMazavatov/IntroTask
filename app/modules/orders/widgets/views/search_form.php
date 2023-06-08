<?php


?>
<form class="form-inline" action="orders/search" method="get">
    <div class="input-group">
        <input type="text" name="search" class="form-control" value="" placeholder="Search orders">
        <span class="input-group-btn search-select-wrap">

            <select class="form-control search-select" name="search-type">
              <option value="1" selected="">Order ID</option>
              <option value="2">Link</option>
              <option value="3">Username</option>
            </select>
            <button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
            </span>
    </div>
</form>
