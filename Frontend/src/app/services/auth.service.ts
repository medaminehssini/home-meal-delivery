import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Global } from '../entities/global.entity';

@Injectable({
  providedIn: 'root'
})
export class AuthService {

  constructor(private http: HttpClient) { }
  global = new Global();

  login(user) {
    return this.http.post(this.global.apiURL + 'api/login', user );
  }
  logout() {
    this.removeToken();
  }
  logedIn() {
    return !!localStorage.getItem('token');

  }
  setToken(token) {
    localStorage.setItem('token', token);
  }
  getToken() {
    return localStorage.getItem('token');
  }

  removeToken() {
    if ( this.getToken() ) {
      localStorage.removeItem('token');
    }
  }
}
