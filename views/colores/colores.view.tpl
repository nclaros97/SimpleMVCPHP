
<h1>
  Gestión de Colores
</h1>
<div class="row depth-1 m-padding">
  <form action="index.php?page=colores" method="post" class="col-md-8 col-offset-2">
      <div class="row s-padding">
        <label class="col-md-1" for="fltDsc">Colores:&nbsp;</label>
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
        <th>Código</th>
        <th>Descrición</th>
        <th>Uso</th>
        <th class="sd-hide">Estado</th>
        <th><a href="index.php?page=color&codigoColor&mode=INS" class="btn depth-1 s-margin">
          <span class="ion-plus-circled"></span>
          </a></th>
      </tr>
    </thead>
    <tbody class="zebra">
      {{foreach colores}}
      <tr>
        <td>{{id}}</td>
        <td>{{codigoColor}}</td>
        <td>{{descripcionColor}}</td>
        <td>{{usosColor}}</td>
        <td class="sd-hide">{{estadoColor}}</td>
        <td class="center">
          <a href="index.php?page=color&id={{id}}&mode=UPD" class="btn depth-1 s-margin"><span class="ion-edit"></span></a>
          <a href="index.php?page=color&id={{id}}&mode=DSP" class="btn depth-1 s-margin"><span class="ion-eye"></span></a>
        </td>
      </tr>
      {{endfor colores}}
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
