import { Component } from '@angular/core';
import { HttpClient } from '@angular/common/http';

@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.css']
})
export class AppComponent {
  title = 'veiculos';

  urlAPI = 'http://127.0.0.1/veiculos/';

  veiculoNovo: string = '';
  marcaNovo: string = '';
  anoNovo: number;
  descricaoNovo: string = '';
  vendidoNovo: any;

  constructor(public http: HttpClient){
    
  }

  criarVeiculo(){
    console.log(this.vendidoNovo);
    if(this.vendidoNovo == true){
      this.vendidoNovo = 1;
    } else {
      this.vendidoNovo = 0;
    }

    let dados = {
      'veiculo': this.veiculoNovo,
      'marca': this.marcaNovo,
      'ano': this.anoNovo,
      'descricao': this.descricaoNovo,
      'vendido': this.vendidoNovo
    }

    return this.http.post(this.urlAPI + 'veiculos_add.php?', JSON.stringify(dados)).subscribe((data) => {
      if(data){
        console.log(data);
      }
    });
  }
}
