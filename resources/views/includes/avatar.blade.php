@if(Auth::user()->image)
                       
                            <img src="{{ route('user.avatar',['filename'=>Auth::user()->image]) }}" class= "img-thumbnail" width="80px" />
                       
                        @endif
