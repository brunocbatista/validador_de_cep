import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { LocalStorageService } from 'src/app/local-storage.service';
import { User } from 'src/app/models/User';
import { AuthService } from 'src/app/services/auth.service';
import { CacheService } from 'src/app/services/cache.service';

@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.css']
})
export class LoginComponent implements OnInit {
  model: User;
  submitError?: string;
  isSubmit: boolean;

  constructor(
    private authService: AuthService,
    private cacheService: CacheService,
    private router: Router,
    private localStorageService: LocalStorageService
  ) { 
    this.model = new User;
    this.isSubmit = false;
  }

  ngOnInit(): void {
  }

  login() {
    this.isSubmit = false;
    this.submitError = undefined;
    if ((this.model.email != undefined && this.model.email != null && this.model.email != '') && (this.model.password != undefined && this.model.password != null && this.model.password != '')) {
      this.authService.login(this.model).subscribe(
        async res => {    
          this.isSubmit = true;
          const data = res.body;
          this.cacheService.user = data.user;
          this.cacheService.token =  data.token;
          
          this.localStorageService.set('user', {...this.cacheService.user, token: this.cacheService.token});
          
          this.router.navigateByUrl('/zip-code');
        },
        error => {
          const errorBody = error.error;
        
          this.submitError = errorBody.message;
          this.isSubmit = true;
        }
      );
    } else {
      this.submitError = 'Nome de Usuário e/ou Senha incorretos.';
      this.isSubmit = true;
    }
  }

}
