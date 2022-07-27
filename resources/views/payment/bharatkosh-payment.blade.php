<!DOCTYPE html>
<html>

<body>
  <form id="bharatkosh" action="{{$postURL}}" method="post">
    <input type="hidden" name="bharrkkosh" value="{{$base64}}">
  </form>
  <script>
    document.getElementById("bharatkosh").submit();
  </script>
</body>

</html>