import { Injectable } from '@angular/core';
import {HttpClient, HttpHeaders} from '@angular/common/http';
import {Observable} from "rxjs";
import { CacheService } from './cache.service';

@Injectable({
  providedIn: 'root'
})
export class HttpService {
  env = 'http://localhost:8000/api';

  constructor(
    private httpClient: HttpClient,
    private cacheService: CacheService
  ) {
  }

  private setUrl(route: string): string {
    return this.env + route;
  }

  private getAuthorizationHeader(headers: HttpHeaders): HttpHeaders {
    const token = this.cacheService.token;
    if (!(token === '' || token == null)) {
      headers = headers.append(
        'Authorization',
        'Bearer ' + token,
      );
    }
    return headers;
  }

  post(endpoint: string, param: any): Observable<any> {
    let headers = new HttpHeaders();
    headers = this.getAuthorizationHeader(headers);
    return this.httpClient.post(this.setUrl(endpoint), param, {
      headers,
      observe: 'response'
    });
  }

  get(endpoint: string): Observable<any> {
    let headers = new HttpHeaders();
    headers = this.getAuthorizationHeader(headers);
    return this.httpClient.get(this.setUrl(endpoint), {headers, observe: 'response'});
  }

  getWithParams(endpoint: string, params: any) {
    let headers = new HttpHeaders();
    headers = this.getAuthorizationHeader(headers);
    return this.httpClient.get(this.setUrl(endpoint), {
        headers,
        observe: 'response',
        params
    });
}
}
