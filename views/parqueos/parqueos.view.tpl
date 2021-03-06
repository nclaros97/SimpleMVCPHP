
<h1>
  Gestión de Parqueos
</h1>
<div class="row depth-1 m-padding">
  <form action="index.php?page=parqueos" method="post" class="col-md-8 col-offset-2">
      <div class="row s-padding">
        <label class="col-md-1" for="fltDsc">Parqueos:&nbsp;</label>
        <input type="text" name="fltDsc"  class="col-md-8"
              id="fltDsc" placeholder="Codigo de colores" value="{{fltDsc}}" />
        <button class="col-md-3" id="btnFiltro"><span class="ion-refresh">&nbsp;Actualizar</span></button>
      </div>
  </form>
</div>
<div class="row depth-1">
  <table class="col-md-12">
    <thead>
      <tr>
        <th>ID</th>
        <th>Estado del parqueo</th>
        <th>Lote</th>
        <th>Tipo</th>
        <th><a href="index.php?page=parqueo&codigoParqueo&mode=INS" class="btn depth-1 s-margin">
          <span class="ion-plus-circled"></span>
          </a></th>
      </tr>
    </thead>
    <tbody class="zebra">
      {{foreach parqueos}}
      <tr>
        <td>{{parqueoid}}</td>
        <td>{{parqueoest}}</td>
        <td>{{parqueolot}}</td>
        <td>{{parqueotip}}</td>
        <td class="center">
          <a href="index.php?page=parqueo&id={{parqueoid}}&mode=UPD" class="btn depth-1 s-margin"><span class="ion-edit"></span></a>
          <a href="index.php?page=parqueo&id={{parqueoid}}&mode=DSP" class="btn depth-1 s-margin"><span class="ion-eye"></span></a>
        </td>
      </tr>
      {{endfor parqueos}}
    </tbody>
  </table>
</div>
<script>
    $().ready(
    function(){
      $("#btnFiltro").click(
        function(e){
          e.preventDefault();
          e.stopPropagation();
          document.forms[0].submit();
        }
      );
    }

    );
</script>
