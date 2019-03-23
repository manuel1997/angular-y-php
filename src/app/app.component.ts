import { Component,  ViewChild, ElementRef} from '@angular/core';
import { ArticulosService } from './articulos.service';
import { HttpClient } from '@angular/common/http';
import {NgForm} from '@angular/forms'; 

import { toast } from 'angular2-materialize';


declare var $: any;


@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.css']
})

export class AppComponent {
   
  onSubmit(f: NgForm) {  
    f.resetForm(); 
   } 

  @ViewChild('focus') private elementRef: ElementRef;

  public ngAfterViewInit(): void {
    this.elementRef.nativeElement.focus();
  }

  articulos=null;
  
  art={
    codigo:null,
    descripcion:null,
    precio:null,
    descripcione:null,
    precioe:null

  }


  constructor(private articulosServicio: ArticulosService) {}

  ngOnInit() {
    this.recuperarTodos();
  }


  muestra(){
    $('#modal1').modal();
   }
 
  miToast() {
    toast("¡FUNCIONA WEY!", 4000,'green');
}

  recuperarTodos() {
    this.articulosServicio.recuperarTodos().subscribe(result => this.articulos = result);
  }

  alta() {
    this.articulosServicio.alta(this.art).subscribe(datos => {
      this.elementRef.nativeElement.focus();
      if (datos['resultado']=='1') {
        toast("¡DATOS AGREGADOS!", 3000,'green');
        this.recuperarTodos();
      }else if (datos['resultado']=='2') {
        toast("¡Error al agregar!", 3000,'red');
        this.recuperarTodos();
      }
    });
  }

  baja(codigo) {
    this.articulosServicio.baja(codigo).subscribe(datos => {
      this.elementRef.nativeElement.focus();
      if (datos['resultado']=='1') {
        toast("¡Producto Eliminado!", 3000,'red');
        this.recuperarTodos();
      }else if (datos['resultado']=='2') {
        alert(datos['msj']);
        this.recuperarTodos();
      }
    });
  }

  modificacion() {
    this.articulosServicio.modificacion(this.art).subscribe(datos => {
      if (datos['resultado']=='OK') {
        toast("¡Producto Modificado!", 3000,'waves-effect blue darken-1');
        this.recuperarTodos();
      }
    });    
  }
  
  seleccionar(codigo) {
    this.articulosServicio.seleccionar(codigo).subscribe(result => this.art = result[0]);
  }


  hayRegistros() {
    return true;
  } 

}
