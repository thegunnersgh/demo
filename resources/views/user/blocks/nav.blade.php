<div id="categorymenu">
      <nav class="subnav">
        <ul class="nav-pills categorymenu">
          <li><a href="{!! url('/') !!}">Trang Chủ</a></li>
          <?php
              $menu_level_1 = DB::table('cates')->where('parent_id', 0)->get();
          ?>
          @foreach($menu_level_1 as $menu_1)
          <li><a class="active"  href="#">{!! $menu_1->name !!}</a>
            <div>
              <ul>
                <?php
                    $menu_level_2 = DB::table('cates')->where('parent_id', $menu_1->id)->get();
                ?>
                @foreach($menu_level_2 as $menu_2)
                    <li><a href="{!! url('loai-san-pham',[$menu_2->id, $menu_2->alias]) !!}">{!! $menu_2->name !!}</a></li>
                @endforeach
              </ul>
            </div>
          </li>
          @endforeach
          <li><a href="contact.html">Contact</a></li>         
        </ul>
      </nav>
      </div>