<select class="form-select" aria-label="Default select example" name="sub_category" id="sub_category" onchange="searchs()">
                <option selected disabled value="">Sub Category</option>
                @foreach($sub_categories as $sub_category)
                <option value="{{$sub_category->id}}">{{$sub_category->name}}</option>
                @endforeach
            </select>