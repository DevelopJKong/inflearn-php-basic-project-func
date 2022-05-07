<?php

return verify([
    ['/auth/login','POST'],
    ['/post/write','POST'],
    ['/post/update','POST'],
    ['/post/delete','GET'],
    ['/user/update','POST'],
]) ?: reject(400);
