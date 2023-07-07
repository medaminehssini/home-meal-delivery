import { Injectable } from '@angular/core';



@Injectable()
export class ScriptService {





  public loadScripts() {
    const scriptTag = document.createElement('script');
    scriptTag.src = 'assets/js/foodpicky.js';
    scriptTag.type = 'text/javascript';
    scriptTag.async = false;
    scriptTag.charset = 'utf-8';
    document.getElementsByTagName('head')[0].appendChild(scriptTag);
  }
}
