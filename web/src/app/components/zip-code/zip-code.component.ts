import { Component, OnInit } from '@angular/core';
import { ZipCode } from 'src/app/models/ZipCode';
import { ZipCodeService } from 'src/app/services/zip-code.service';

@Component({
  selector: 'app-zip-code',
  templateUrl: './zip-code.component.html',
  styleUrls: ['./zip-code.component.css']
})
export class ZipCodeComponent implements OnInit {
  model: ZipCode;
  all: ZipCode[];

  submitError?: string;
  isSubmit: boolean;

  loadingError?: string;
  isLoading: boolean;

  constructor(
    private zipCodeService: ZipCodeService
  ) { 
    this.model = new ZipCode;
    this.all = [];
    this.isSubmit = false;
    this.isLoading = false;
  }

  ngOnInit(): void {
    this.allZipCodes();
  }

  allZipCodes() {
    this.zipCodeService.all().subscribe(
      async res => {    
        this.isLoading = true;
        this.all = res.body;
        if (this.all.length === 0) {
          this.loadingError = 'Não há CEP cadastrado.';
        }        
      },
      error => {
        const errorBody = error.error;
      
        this.loadingError = errorBody.message;
        this.isLoading = true;
      }
    );
  }

  addZipCode() {
    this.isSubmit = false;
    this.submitError = undefined;
    if (this.zipCodeService.validValue(this.model.value || 0) && (this.model.city != undefined && this.model.city != null && this.model.city != '') && (this.model.state != undefined && this.model.state != null && this.model.state != '' && this.model.state.length === 2) ) {
      this.zipCodeService.add(this.model).subscribe(
        async res => {    
          this.isSubmit = true;
          this.model = new ZipCode();
          this.allZipCodes();
        },
        error => {
          const errorBody = error.error;
        
          this.submitError = errorBody.message;
          this.isSubmit = true;
        }
      );
    } else {
      this.submitError = 'Cep (tamanho máximo: 6), cidade e estado (tamanho máximo: 2) são obrigatórios.';
      this.isSubmit = true;
    }
  }

}
