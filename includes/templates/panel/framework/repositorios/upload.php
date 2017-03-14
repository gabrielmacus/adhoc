<style>
    .fancybox-close-small
    {
        background-color: white!important;

    }
</style>
<script>
    $(document).on("submit","form",function (e) {



        var data = new FormData();
        $.each(files, function(key, value)
        {
            data.append(key, value);
        });

        var serializedForm =$(this).serializeArray();

        $.each(serializedForm,function(key,value)
        {
            data.append(value["name"], value["value"]);
        });


        $.ajax({
            url: "files-data.php?act=add&rep="+$("[name='archivo_repositorio']").val(),
            type: "post",
            dataType: "html",
            data: data,
            cache: false,
            contentType: false,
            processData: false,
            success:function(res)
            {

                console.log(res);

                try{
                    res = JSON.parse(res);


                    if(res&&!res.error)
                    {

                        window.location="files.php?rep="+$("[name='archivo_repositorio']").val();
                    }
                    else
                    {


                        error(null,"<?php echo $lang["errors"]["filesError"]["text"]; ?>"+res.error.join());
                    }

                }
                catch(e)
                {
                    error();
                }

            }
        })



        e.preventDefault();
    });
    $(document).ready(function () {
        angular.element(document).ready(function () {
            scope.adjuntos=[]; // Your document is ready, place your code here

            scope.deleteFile=function (file) {


              var idx=files.findIndex(
                  function (e) {

                      return e.name == file.name
                  }
              );

                files.splice(idx,1);

                 idx=scope.adjuntos.indexOf(file);

                scope.adjuntos.splice(idx,1);
                console.log(files);

            }
        });
    });
    var files=[];
    $(document).on("change","[type='file']",function () {


    var inputFiles = this.files;


        readFile(this.files,1,function (data,name) {


            scope.adjuntos.push({src:data,name:name});




        },function () {
            $.merge( files ,inputFiles);
            scope.$apply();
        });

    });




</script>

<form class="row">

    <div class="col s12 m12 l12">
        <h2>Subir archivos</h2>

        <div class="file-field input-field">
            <div class="btn">
                <span>ARCHIVO</span>
                <input id="archivos" type="file" name="archivos" multiple>
            </div> 
            <div class="file-path-wrapper">
                <input id="files"  class="file-path validate" type="text" placeholder="Uno o mas archivos">
            </div>
        </div>

        <div class="input-field ">
            <select name="archivo_repositorio">
                <option value="" disabled selected>Elegi una opcion</option>
                <?php foreach ($repositorios as $item)

                {
                    ?>
                    <option value="<?php echo $item["repositorio"]?>"><?php echo $item["nombre"];?></option>
                    <?php
                }?>

            </select>
            <label>Repositorio</label>
        </div>
    </div>
<style>


    .animate-repeat.ng-move,
    .animate-repeat.ng-enter,
    .animate-repeat.ng-leave {
        transition:all linear 0.5s;
    }

    .animate-repeat.ng-leave.ng-leave-active,
    .animate-repeat.ng-move,
    .animate-repeat.ng-enter {
        opacity:0;
        max-height:0;
    }

    .animate-repeat.ng-leave,
    .animate-repeat.ng-move.ng-move-active,
    .animate-repeat.ng-enter.ng-enter-active {
        opacity:1;
    }
</style>
    <div class="col s12">
        <div   class="col s12 m4 l3 animate-repeat" data-ng-repeat="a in adjuntos">
            <div class="card">
                <div class="card-image" style="position: relative">
                    <img   style="height: 150px;object-fit: cover" data-ng-src="{{a.src}}">
                    <a data-ng-click="deleteFile(a)" style="position: absolute;top: 10px;right: 10px;">
                        <i  style="font-size: 36px" class="material-icons red-text">delete_forever</i>
                    </a>
                </div>

                <div class="card-action">
                    <a class="truncate" href="#">{{a.name}}</a>
                </div>
            </div>
        </div>
    </div>
    <div class="col s12">

        <div class="progress" style="display: none;">
            <div class="determinate" style="width: 0%"></div>
        </div>


        <button class="btn waves-effect right waves-light" type="submit" >Aceptar
            <i class="material-icons right">send</i>
        </button>
    </div>

</form>
