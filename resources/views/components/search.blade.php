 <form class="form-group" action="" method="GET">
     <div class="input-group ">
         <input type="text" name="name" class="form-control form-control-lg" placeholder="name"
             value={{ Request::get('name') }}>

         <input type="text" name="email" class="form-control form-control-lg" placeholder="Email"
             value={{ Request::get('email') }}>
         <input type="date" name="date" class="form-control form-control-lg" value={{ Request::get('date') }}>
         <div class="input-group-append">
             <button type="submit" class="btn btn-lg btn-default">
                 <i class="fa fa-search"></i>
                 Search
             </button>
         </div>
         <div class="input-group-append">
             <a href="{{ route('admin.index') }}" class="btn btn-lg btn-default">
                 <i class="fa fa-cancel"></i>
                 Clear
             </a>
         </div>
     </div>

 </form>
