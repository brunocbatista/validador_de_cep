import { NgModule } from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';

import { AppComponent } from './app.component';
import { FormsModule }   from '@angular/forms';
import { LoginComponent } from './components/login/login.component';
import { RegisterComponent } from './components/register/register.component';
import { HttpClientModule } from '@angular/common/http';
import { ZipCodeComponent } from './components/zip-code/zip-code.component';
import { AppRoutingModule } from './app-routing.module';
import { DetailZipCodeComponent } from './components/detail-zip-code/detail-zip-code.component';
import { StorageServiceModule } from 'ngx-webstorage-service';

@NgModule({
  declarations: [
    AppComponent,
    LoginComponent,
    RegisterComponent,
    ZipCodeComponent,
    DetailZipCodeComponent,
  ],
  imports: [
    BrowserModule,
    HttpClientModule,
    FormsModule,
    AppRoutingModule,
    StorageServiceModule 
  ],
  providers: [],
  bootstrap: [AppComponent]
})
export class AppModule { }
