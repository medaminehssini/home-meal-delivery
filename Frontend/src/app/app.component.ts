import { Component } from '@angular/core';
import { Router, Event, NavigationStart, NavigationEnd, NavigationError } from '@angular/router';

@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.css']
})
export class AppComponent   {
  title = 'Frontend';

  constructor(private router: Router) {
    this.getmypos();
    this.router.events.subscribe((event: Event) => {
      if (event instanceof NavigationEnd) {
          // Hide loading indicator
          this.loadScripts('assets/js/foodpicky.js');
      }


  });
}

public loadScripts(url) {
  const scriptTag = document.createElement('script');
  scriptTag.src = url;
  scriptTag.type = 'text/javascript';
  scriptTag.async = false;
  scriptTag.charset = 'utf-8';
  document.getElementsByTagName('head')[0].appendChild(scriptTag);
}







getmypos() {
  navigator.geolocation.getCurrentPosition(this.mypos);

}
mypos(position) {
  const pos = {
    lat: position.coords.latitude,
    lng: position.coords.longitude
  };
  localStorage.setItem('pos' , JSON.stringify(pos));
  const geocoder = new google.maps.Geocoder();

  // tslint:disable-next-line:only-arrow-functions
  geocoder.geocode({location: pos}, function(results, status) {
    if (status === google.maps.GeocoderStatus.OK) {
            if (results[0]) {
                const add = results[3].formatted_address ;
                const  value = add.split(',');
                localStorage.setItem('ville' , value[value.length - 2] );
            }
    }
  });

}

}
