@extends('layouts.master')
@section('title', 'home')
@section('content')
<div>
<h1>Materias en curso</h1>
    <div class="container" style="margin-top:5vh;">
        <div class="row">
            <div class="col-8 col-md-3">
                <h6>Elije la Materia que vas a inscribir</h6>
                <select class="custom-select" id="selectCareerControl">
                    
                                <option value="1">relleno</option>
                </select>   
            </div>

            <div class="col-8 col-md-3">
                <h6>Hora de inicio</h6>
                <select class="custom-select" id="horaInicio">
                    @foreach(range(7, 20) as $h)
                        <option value="{{$h}}">{{$h}}:00</option>
                    @endforeach
                </select>   
            </div>

            <div class="col-8 col-md-3">
                <h6>Hora de fin</h6>
                <select class="custom-select" id="horaFin">
                    @foreach(range(7, 20) as $h)
                        <option value="{{$h}}">{{$h}}:00</option>
                    @endforeach
                </select>   
            </div>

            <div class="col-8 col-md-3">
                <h6>Numero de parciales</h6>
                <select class="custom-select" id="selectNumParciales">
                    @foreach(range(3, 5) as $p)
                        <option value="{{$p}}">{{$p}}</option>
                    @endforeach
                </select>   
            </div>
        </div>
        <div class="row" style="margin-top:1rem;">
            <div class="col-8 col-md-4">
                <h6>Nombre del profesor</h6>
                <input type="text" class="form-control col-8 col-md-8" id="nombreProf" aria-describedby="basic-addon3">
            </div>
            <div class="col-8 col-md-4" style="margin">
                <h6 style="visibility: hidden;">con</h6>
                <button class="btn btn-primary" onclick="guardaCursos()">Confirma Materias</button>
            </div>
        </div>
    </div>

    <div class="container" style="margin-top:5vh;">
        <table class="table table-bordered table-hover" align="center" id="subjects-table">
            <thead>
                <tr>
                    <td width="10%" class="table-warning">

                    </td>
                    <td width="25%" class="table-warning"><b>Nombre</b></td>
                    <td width="20%" class="table-warning"><b>Profesor</b></td>
                    <td width="10%" class="table-warning"><b>Créditos</b></td>
                    <td width="10%" class="table-warning"><b>Parciales</b></td>
                    <td width="10%" class="table-warning"><b>Inicio</b></td>
                    <td width="10%" class="table-warning"><b>Fin</b></td>
                </tr>
            </thead>
            <tbody id="content-table">
                @if(!is_null($array_cursos_activos))
                        @foreach($array_cursos_activos as $curso)
                            @if($loop->index % 2 == 0)
                            <tr class="table-info">
                                <td>
                                    <button class="btn btn-primary" onclick="imprime({{$curso['id']}})">Info</button>
                                </td>
                                <td>{{$curso['nombre_materia']}}</td>
                                <td>{{$curso['nombre_profesor']}}</td>
                                <td>{{$curso['creditos']}}</td>
                                <td>{{$curso['num_parciales']}}</td>
                                <td>{{$curso['hora_inicio']}}:00</td>
                                <td>{{$curso['hora_fin']}}:00</td>
                            </tr>
                            @else
                            <tr class="table-light">
                                <td>
                                    <button class="btn btn-primary" onclick="imprime({{$curso['id']}})">Info</button>
                                </td>
                                <td>{{$curso['nombre_materia']}}</td>
                                <td>{{$curso['nombre_profesor']}}</td>
                                <td>{{$curso['creditos']}}</td>
                                <td>{{$curso['num_parciales']}}</td>
                                <td>{{$curso['hora_inicio']}}:00</td>
                                <td>{{$curso['hora_fin']}}:00</td>
                            </tr>
                            @endif
                        @endforeach
                @endif
            </tbody>
        </table>
    </div>
</div>

<script>

const tabla = document.querySelector('#content-table');
let materias = {!! json_encode($array_cursos_activos) !!};
let numMaterias = 0;
let idMateriasAgregadas = [];
let home_url = "{{ url('home') }}";

function imprime(params) {
    console.log(params);
}

async function agregaInfoMateria() {
    //tabla.innerHTML = '';

    materia_seleccionada_id = document.querySelector('#selectCareerControl').value;
    hInicioSeleccionada = document.querySelector('#horaInicio').value;
    hFinSeleccionada = document.querySelector('#horaFin').value;
    numParcialesSeleccionada = document.querySelector('#selectNumParciales').value;
    nombreProfesor = document.querySelector('#nombreProf').value;
    

    if(idMateriasAgregadas.indexOf(Number(materia_seleccionada_id)) === -1 && hInicioSeleccionada < hFinSeleccionada){
        materias.forEach(materia => {
            if(materia.id == materia_seleccionada_id){
                if (!(numMaterias%2 == 0)) {
                    tabla.innerHTML += `
                        <tr class="table-light">
                            <td>${materia.id}</td>
                            <td>${materia.creditos}</td>
                            <td>${materia.name}</td>
                            <td>${hInicioSeleccionada}</td>
                            <td>${hFinSeleccionada}</td>
                            <td>${numParcialesSeleccionada}</td>
                            <td>${nombreProfesor}</td>
                        </tr>
                    `;
                }
                else{
                    tabla.innerHTML += `
                        <tr class="table-info">
                            <td>${materia.id}</td>
                            <td>${materia.creditos}</td>
                            <td>${materia.name}</td>
                            <td>${hInicioSeleccionada}</td>
                            <td>${hFinSeleccionada}</td>
                            <td>${numParcialesSeleccionada}</td>
                            <td>${nombreProfesor}</td>
                        </tr>
                    `;
                }
                idMateriasAgregadas.push(materia.id);
            }
        });
        numMaterias++;
    } else {
        if(hInicioSeleccionada >= hFinSeleccionada)
            alert("La hora de inicio tiene que ser menor que la final");
        else
            alert("Esa materia ya esta agregada");
    
    }
}

function changeStateofSubject(selected){

    selected.parentNode.parentNode.children[1].textContent = selected.checked.toString();
}
/* Este fue el código que pegue de la pagina*/
$( document ).ready(function() {
!function(a){"use strict";a.fn.tableToJSON=function(b){var c={ignoreColumns:[],onlyColumns:null,ignoreHiddenRows:!0,ignoreEmptyRows:!1,headings:null,allowHTML:!1,includeRowId:!1,textDataOverride:"data-override",textExtractor:null};b=a.extend(c,b);var d=function(a){return void 0!==a&&null!==a},e=function(c){return d(b.onlyColumns)?-1===a.inArray(c,b.onlyColumns):-1!==a.inArray(c,b.ignoreColumns)},f=function(b,c){var e={},f=0;return a.each(c,function(a,c){f<b.length&&d(c)&&(e[b[f]]=c,f++)}),e},g=function(c,d,e){var f=a(d),g=b.textExtractor,h=f.attr(b.textDataOverride);return null===g||e?a.trim(h||(b.allowHTML?f.html():d.textContent||f.text())||""):a.isFunction(g)?a.trim(h||g(c,f)):"object"==typeof g&&a.isFunction(g[c])?a.trim(h||g[c](c,f)):a.trim(h||(b.allowHTML?f.html():d.textContent||f.text())||"")},h=function(c,d){var e=[],f=b.includeRowId,h="boolean"==typeof f?f:"string"==typeof f?!0:!1,i="string"==typeof f==!0?f:"rowId";return h&&"undefined"==typeof a(c).attr("id")&&e.push(i),a(c).children("td,th").each(function(a,b){e.push(g(a,b,d))}),e},i=function(a){var c=a.find("tr:first").first();return d(b.headings)?b.headings:h(c,!0)},j=function(c,h){var i,j,k,l,m,n,o,p=[],q=0,r=[];return c.children("tbody,*").children("tr").each(function(c,e){if(c>0||d(b.headings)){var f=b.includeRowId,h="boolean"==typeof f?f:"string"==typeof f?!0:!1;n=a(e);var r=n.find("td").length===n.find("td:empty").length?!0:!1;!n.is(":visible")&&b.ignoreHiddenRows||r&&b.ignoreEmptyRows||n.data("ignore")&&"false"!==n.data("ignore")||(q=0,p[c]||(p[c]=[]),h&&(q+=1,"undefined"!=typeof n.attr("id")?p[c].push(n.attr("id")):p[c].push("")),n.children().each(function(){for(o=a(this);p[c][q];)q++;if(o.filter("[rowspan]").length)for(k=parseInt(o.attr("rowspan"),10)-1,m=g(q,o),i=1;k>=i;i++)p[c+i]||(p[c+i]=[]),p[c+i][q]=m;if(o.filter("[colspan]").length)for(k=parseInt(o.attr("colspan"),10)-1,m=g(q,o),i=1;k>=i;i++)if(o.filter("[rowspan]").length)for(l=parseInt(o.attr("rowspan"),10),j=0;l>j;j++)p[c+j][q+i]=m;else p[c][q+i]=m;m=p[c][q]||g(q,o),d(m)&&(p[c][q]=m),q++}))}}),a.each(p,function(c,g){if(d(g)){var i=d(b.onlyColumns)||b.ignoreColumns.length?a.grep(g,function(a,b){return!e(b)}):g,j=d(b.headings)?h:a.grep(h,function(a,b){return!e(b)});m=f(j,i),r[r.length]=m}}),r},k=i(this);return j(this,k)}}(jQuery);
});

function guardaCursos() {
    var table = $('#subjects-table').tableToJSON({
        ignoreColumns: [1, 2]
    }); // Convert the table into a javascript object
    infoArray = JSON.stringify(table);
    
    /*table.forEach(element => {
        console.log(element)
    });*/

    let data = { materiasInfo: infoArray };
    let url = "{{ url('course') }}";
    console.log(url);
    
    fetch(url, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            "Accept": "application/json, text-plain, *//*",
            "X-Requested-With": "XMLHttpRequest",
            "X-CSRF-TOKEN": "{{ csrf_token() }}"
        },
        body: JSON.stringify(table),
    })
    .then(response => response.json())
    .then(data => {
        console.log('Success:', data);
        console.log("Yeiiiiiiiii");
        window.location.href = home_url;
    })
    .catch((error) => {
        console.log('Error:', error);
    });
    
}

</script>
@endsection
