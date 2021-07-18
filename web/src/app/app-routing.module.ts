import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { DetailZipCodeComponent } from './components/detail-zip-code/detail-zip-code.component';
import { LoginComponent } from './components/login/login.component';
import { RegisterComponent } from './components/register/register.component';
import { ZipCodeComponent } from './components/zip-code/zip-code.component';
import { AnonymousGuardService } from './services/anonymous-guard.service';
import { AuthGuardService } from './services/auth-guard.service';

const routes: Routes = [
  { path: '', component: DetailZipCodeComponent },
  { path: 'login', component: LoginComponent, canActivate:[AnonymousGuardService]},
  { path: 'register', component: RegisterComponent, canActivate:[AnonymousGuardService]},
  { path: 'zip-code', component: ZipCodeComponent, canActivate:[AuthGuardService]}
];

@NgModule({
  imports: [
    RouterModule.forRoot(routes)
  ],
  exports: [RouterModule]
})
export class AppRoutingModule { }
