import { Component, OnInit } from '@angular/core';
import { ZipCode } from 'src/app/models/ZipCode';
import { ZipCodeService } from 'src/app/services/zip-code.service';

@Component({
  selector: 'app-detail-zip-code',
  templateUrl: './detail-zip-code.component.html',
  styleUrls: ['./detail-zip-code.component.css']
})
export class DetailZipCodeComponent implements OnInit {
  zipCodeValue: any;
  zipCodeObject: ZipCode;
  zipCodeError?: string;
  zipCodeIsLoading: boolean;

  constructor(
    private zipCodeService: ZipCodeService
  ) { 
    this.zipCodeValue = null;
    this.zipCodeObject = new ZipCode();
    this.zipCodeIsLoading = false;
  }

  ngOnInit(): void {
  }

  detailZipCode() {
    this.zipCodeIsLoading = false;
    this.zipCodeError = undefined;
    if (this.zipCodeService.validValue(this.zipCodeValue)) {
      this.zipCodeService.details(this.zipCodeValue).subscribe(
        res => {
          this.zipCodeObject = res.body as ZipCode;
          
          if (Object.keys(this.zipCodeObject).length === 0) {
            this.zipCodeError = 'Não encontramos informações para o CEP informado.'
            
          }

          this.zipCodeIsLoading = true;
          
        },
        error => {
          const errorBody = error.error;
          this.zipCodeError = errorBody.message;

          this.zipCodeIsLoading = true;
        }
      )
    } else {
      this.zipCodeError = 'O valor para CEP não condiz com a regra de validação.'
      this.zipCodeIsLoading = true;
    }
  }

}
