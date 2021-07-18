import { Injectable } from '@angular/core';
import { ActivatedRouteSnapshot, Router, RouterStateSnapshot } from '@angular/router';
import { AuthService } from './auth.service';

@Injectable({
  providedIn: 'root'
})
export class AnonymousGuardService {
  constructor(private authService: AuthService, private router: Router) {}

  canActivate(
    next: ActivatedRouteSnapshot,
    state: RouterStateSnapshot): boolean {
    if(!this.authService.isRouteAuthenticated()){
      return true;
    }
    this.router.navigateByUrl("/");
    return false;
  }

   canActivateChild(
    next: ActivatedRouteSnapshot,
    state: RouterStateSnapshot): boolean {
    if(!this.authService.isRouteAuthenticated()){
      return true;
    }
    this.router.navigateByUrl("/");
    return false;
  }
}
