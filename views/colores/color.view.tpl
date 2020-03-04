<h1>Gestión de Color</h1>
<div class="row depth-1 m-padding">
  <h2>{{modeDesc}}</h2>
</div>
<div class="row depth-1 m-padding">
  {{if haserrores}}
    <ul class="alert alert-danger depth-1 m-padding" style="list-style:none;">
      {{foreach errores}}
        <li>
          {{this}}
        </li>
      {{endfor errores}}
    </ul>
  {{endif haserrores}}
  <form action="index.php?page=color" method="post" class="col-sm-8 col-sm-offset-2 col-md-6 col-offset-3">
    <input type="hidden" name="mode" value="{{mode}}"  />
    <input type="hidden" name="tocken" value="{{tocken}}"  />
    <input type="hidden" name="id" value="{{id}}"  />
    <div class="row">
    
      <div class="row s-padding">
        <label class="col-sm-5">Código del color</label>
        <input class="col-sm-7" {{readonly}}  type="text" name="txtCodigoColor" id="txtCodigoColor" value="{{codigoColor}}" placeholder="Codigo de Color" />
      </div>
    <div class="row s-padding">
      <label class="col-sm-5">Usos</label>
      <input class="col-sm-7" {{readonly}} type="text" name="txtUsoColor" id="txtUsoColor" value="{{usosColor}}" placeholder="Usos del Color" />
    </div>
        <div class="row s-padding">
      <label class="col-sm-5">Descripción</label>
      <input class="col-sm-7" {{readonly}} type="text" name="txtDescripcionColor" id="txtDescripcionColor" value="{{descripcionColor}}" placeholder="Descripcion del Color" />
    </div>
    <div class="row s-padding">
      <label class="col-sm-5">Estado</label>
      <span class="select col-sm-7"><select {{if readonly}}disabled readonly="readonly" {{endif readonly}} class="col-md-12" id="cmbEstado" name="cmbEstado">
        {{foreach estadoColorC}}
          <option value="{{codigo}}" {{selected}}>{{valor}}</option>
        {{endfor estadoColorC}}
      </select> </span>
    </div>

    <div class="row s-padding">
      <div class="col-md-12 right">
        {{ifnot readonly}}
        <button id="btnConfirm"><span class="icon "></span>Confirmar</button>
        {{endifnot readonly}}
        <button id="btnCancel">Cancelar</button>
      </div>
    </div>
    </div>
  </form>
</div>

<script>
  $().ready(function(){
      $("#btnConfirm").click(function(e){
        e.preventDefault();
        e.stopPropagation();
        document.forms[0].submit();
        });
      $("#btnCancel").click(function(e){
          e.preventDefault();
          e.stopPropagation();
          window.location.assign("index.php?page=colores");
          });
          
    });

</script>
