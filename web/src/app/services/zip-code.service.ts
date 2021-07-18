import { Injectable } from '@angular/core';
import { Observable } from 'rxjs';
import { ZipCode } from '../models/ZipCode';
import { Endpoints } from '../helpers/endpoints';
import { HttpService } from './http.service';

@Injectable({
  providedIn: 'root'
})
export class ZipCodeService {
  endpoints = Endpoints;

  constructor(
    private http: HttpService
  ) { }

  all(): Observable<any> {
    return this.http.get(this.endpoints.zipCode);
  }

  add(zipCodeData: ZipCode): Observable<any> {
    return this.http.post(this.endpoints.zipCode, zipCodeData);
  }

  details(zipCodeValue: number): Observable<any> {
    return this.http.get(this.endpoints.zipCode + '/' + zipCodeValue);
  }

  validValue(zipCodeValue: number) {
      if (zipCodeValue > 100000 && zipCodeValue < 999999) {
          return true;
      }

      return false;
  }
}
