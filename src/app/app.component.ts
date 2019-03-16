import { Component } from '@angular/core';
import { ArticulosService } from './articulos.service';
import { HttpClient } from '@angular/common/http';

import { toast } from 'angular2-materialize';

@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.css']
})

export class AppComponent {

  articulos=null;
  
  art={
    codigo:null,
    descripcion:null,
    precio:null

  }

  constructor(private articulosServicio: ArticulosService) {}

  ngOnInit() {
    this.recuperarTodos();
  }

  miToast() {
    toast("¡FUNCIONA WEY!", 4000,'green');
}

  recuperarTodos() {
    this.articulosServicio.recuperarTodos().subscribe(result => this.articulos = result);
  }

  alta() {
    this.articulosServicio.alta(this.art).subscribe(datos => {
      if (datos['resultado']=='1') {
        toast("¡DATOS AGREGADOS!", 4000,'green');
        this.recuperarTodos();
      }else if (datos['resultado']=='2') {
        toast("¡error al agregar!", 4000,'red');
        this.recuperarTodos();
      }
    });
  }

  baja(codigo) {
    this.articulosServicio.baja(codigo).subscribe(datos => {
      if (datos['resultado']=='1') {
        alert(datos['mensaje']);
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
        alert(datos['mensaje']);
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
