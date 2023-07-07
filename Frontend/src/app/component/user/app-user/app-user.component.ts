import { Component, OnInit } from '@angular/core';
import { UserDataService } from 'src/app/services/user-data.service';

@Component({
  selector: 'app-app-user',
  templateUrl: './app-user.component.html',
  styleUrls: ['./app-user.component.css']
})
export class AppUserComponent implements OnInit {
  userDetails = null;
  constructor(    private dataUser: UserDataService
    ) {
  }

  ngOnInit(): void {
    this.dataUser.currentMessage.subscribe(message => {
      this.userDetails = message ;
    });
  }

}
