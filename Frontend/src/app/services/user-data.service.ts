import { Injectable } from '@angular/core';
import { BehaviorSubject } from 'rxjs';
import { HttpClient } from '@angular/common/http';
import { Global } from '../entities/global.entity';
@Injectable({
  providedIn: 'root'
})
export class UserDataService {
  global = new Global();


  private messageSource = new BehaviorSubject('null');
  currentMessage = this.messageSource.asObservable();
  constructor(
    private http: HttpClient
    ) {
      this.getData();
    }

  changeMessage(data) {
    this.messageSource.next(data);
  }
  getData() {
    this.http.post(this.global.apiURL + '/api/details', {}).subscribe(success => {
      this.changeMessage(Object(success).success);
    });
  }

}
