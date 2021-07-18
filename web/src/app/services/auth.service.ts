import { Injectable } from '@angular/core';
import { Observable } from 'rxjs';
import { Endpoints } from '../helpers/endpoints';
import { User } from '../models/User';
import { CacheService } from './cache.service';
import { HttpService } from './http.service';

@Injectable({
  providedIn: 'root'
})
export class AuthService {
  endpoints = Endpoints;

  constructor(
    private http: HttpService,
    private cacheService: CacheService
  ) { }

  isRouteAuthenticated() {
    return this.cacheService.token != undefined && this.cacheService.token != null &&  this.cacheService.token != '';
  }

  register(userModel: User): Observable<any> {
    return this.http.post(this.endpoints.register, userModel);
  }

  login(userModel: User): Observable<any> {
    return this.http.post(this.endpoints.login, userModel);
  }
}
