import { Component } from '@angular/core';
import { Router } from '@angular/router';
import { LocalStorageService } from './local-storage.service';
import { User } from './models/User';
import { CacheService } from './services/cache.service';

@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.css']
})
export class AppComponent {
  constructor (
    private localStorageService: LocalStorageService,
    public cacheService: CacheService,
    private router: Router
  ) {
    this.loadInfos();
  }

  loadInfos () {
    this.cacheService.user = this.localStorageService.get('user');
    this.cacheService.token = this.cacheService.user != null ? this.cacheService.user.token : undefined;
  }

  logout () {
    this.cacheService.user = new User();
    this.cacheService.token = undefined;
    this.localStorageService.remove('user');
    this.router.navigateByUrl('/login')
  }
}
