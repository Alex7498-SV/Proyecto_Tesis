<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpOffice\PhpWord\Style\Language;
use PhpOffice\PhpWord\Style\TOC;
use PhpOffice\PhpWord\TemplateProcessor;

use App\Models\SeccionCapitulo;
use App\Models\ContenidoSeccionCapitulo;
use App\Models\SubcontenidoSeccionCapitulo;

class EstudianteController extends Controller
{
    //-------------------------------------Creación de capitulos-----------------------------------
        
    public function formCapitulos()
    {
        $capitulo = SeccionCapitulo::orderBy("orden_capitulo", 'asc')->where('grupo_trabajo_id', '=', 1)->get();
        return view("formulariosDoc.capitulo", array(
            "capitulos" => $capitulo
        ));
    }

    public function registrar(Request $request)
    {
        $capitulo = new SeccionCapitulo();
        $capitulo->nombre_capitulo = $request->input('nombreTitulo');
        $capitulo->orden_capitulo = $request->input('orden_capitulo');
        //$capitulo->grupo_trabajo_id = $request->input('orden_capitulo');
        $capitulo->grupo_trabajo_id = 1;
        $capitulo->save();

        $capitulos = SeccionCapitulo::orderBy("orden_capitulo", 'asc')->get();
        return $capitulos;
    }

    public function modificar(Request $request)
    {
        if($request->input('idList')){
            $ids = json_decode($request->input('idList'));
            $cont = 1;
            foreach ($ids as $id) {
                $capitulo = SeccionCapitulo::findOrFail($id);
                $capitulo->orden_capitulo = $cont++;
                $capitulo->update();
            }   
        } else if($request->input('id')){
            $id = $request->input('id');
            $nombre = $request->input('nombre');
            $capitulo = SeccionCapitulo::findOrFail($id);
            $capitulo->nombre_capitulo = $nombre;
            $capitulo->update();   
            $capitulos = SeccionCapitulo::orderBy("orden_capitulo", 'asc')->get();
            return $capitulos;
        }
    }

    public function eliminar(Request $request)
    {
        $id = $request->input('id');
        $capitulo = SeccionCapitulo::findOrFail($id);
        $capitulo->delete();
    }

    //-----------------------------------Agregar temas y subtemas de capitulos-------------------------------------------

    public function formularioDinamico($id){ 
        // Validar que el contenido que se pueda ver corresponda al equipo
        $capitulo = SeccionCapitulo::with('contenidoSeccionCapitulo')->where('grupo_trabajo_id', '=', 1)->findOrFail($id);

        $contenido = ContenidoSeccionCapitulo::with('contenidoCapitulo2')->orderBy("orden_contenido", 'asc')->where('seccion_capitulo_id', '=', $id)->where('orden_contenido', '>',0)->get();
        $contenido_introduccion = ContenidoSeccionCapitulo::with('contenidoCapitulo2')->where('seccion_capitulo_id', '=', $id)->where('orden_contenido', '=',0)->get();
        return view('formulariosDoc.dinamico', array(
            "capitulo" => $capitulo,
            "contenido" => $contenido,
            "introduccion" => $contenido_introduccion
        ));
    }

    public function crearDinamico(Request $request){
        $id = $request->input('idCapitulo');
        $i = 0;
        $i2 = 0;
        foreach ($request->input('seccion1') as $seccion) {
            $idCont = $request->input('seccion3')[$i];
            $tipo = $request->input('seccion4')[$i];
            $idTitulo;
            if($tipo == 2){
                if ($idCont == 0) {
                    $contenidoCapitulo2 = new SubcontenidoSeccionCapitulo();
                } else{
                    $contenidoCapitulo2 = SubcontenidoSeccionCapitulo::findOrFail($idCont);
                }
                $contenidoCapitulo2->subtema = $seccion;
                $contenidoCapitulo2->contenido = $request->input('seccion2')[$i];
                $contenidoCapitulo2->orden_subcontenido = $i;
                if($request->input('seccion5')[$i2] == 0){
                    $contenidoCapitulo2->contenido_seccion_capitulo_id  = $idTitulo;
                } else{
                    $contenidoCapitulo2->contenido_seccion_capitulo_id = $request->input('seccion5')[$i2];
                }
                if ($idCont == 0) {
                    $contenidoCapitulo2->save(); 
                } else{
                    $contenidoCapitulo2->update(); 
                }
                ++$i2;
            } else{
                if ($idCont == 0) {
                    $contenidoCapitulo = new ContenidoSeccionCapitulo();
                } else{
                    $contenidoCapitulo = ContenidoSeccionCapitulo::findOrFail($idCont);
                }
                $contenidoCapitulo->tema = $seccion;
                if($i == 0){
                    if ($request->input('seccion2')[$i] == null) {
                        $contenidoCapitulo->contenido = "<p>null</p>";    
                    } else{
                        $contenidoCapitulo->contenido = $request->input('seccion2')[$i];  
                    }
                } else{
                    $contenidoCapitulo->contenido = $request->input('seccion2')[$i];   
                }
                $contenidoCapitulo->orden_contenido = $i;
                $contenidoCapitulo->seccion_capitulo_id = $id;
                if ($idCont == 0) {
                    $contenidoCapitulo->save(); 
                    $idTitulo=  $contenidoCapitulo->id;
                } else{
                    $contenidoCapitulo->update(); 
                }
            }
            ++$i;
        }
        return redirect('fdinamico/'.$id)->with('status', 'Se guardo exitosamente!');
    }

    public function eliminarContenido(Request $request)
    {
        $id = $request->input('id');
        $contenido = ContenidoSeccionCapitulo::findOrFail($id);
        $contenido->delete();
    }

    public function eliminarContenido2(Request $request)
    {
        $id = $request->input('id');
        $contenido = SubcontenidoSeccionCapitulo::findOrFail($id);
        $contenido->delete();
    }
}
