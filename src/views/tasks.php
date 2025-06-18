<div class="list-group">
    <ul>
      <?php foreach ($tasks as $task): ?>
          <li href="#" class="list-group-item list-group-item-action">
              <form>
                  <div class="d-flex w-100 row">
                      <h5 class="mb-1">
                          <input class="form-check-input me-2"
                                 type="checkbox" value=""
                                 id="firstCheckbox">
                          <input type="text"
                                 name="title"
                                 class="border-0 col-sm-10"
                                 required
                                 value="<?php echo $task['title']; ?>">
                      </h5>
                  </div>
                  <p class="mb-1"><textarea
                              type="text"
                              name="description"
                              class="border-0 form-control"
                              rows="2"
                              value="<?php echo $task['description']; ?>"></textarea>
                  </p>
                  <div class="d-flex w-100 justify-content-between">
                      <small>Created by X</small>
                      <small>Assigned to X</small>
                  </div>
              </form>
          </li>
      <?php endforeach; ?>
        <li href="#" class="list-group-item list-group-item-action">
            <form>
                <div class="d-flex w-100 row">
                    <h5 class="mb-1">
                        <input class="form-check-input me-2"
                               type="checkbox" value=""
                               disabled
                               id="firstCheckbox">
                        <input type="text"
                               name="title"
                               class="border-0 col-sm-10"
                               required
                               value="">
                    </h5>
                </div>
                <p class="mb-1"><textarea
                            type="text"
                            name="description"
                            class="border-0 form-control"
                            rows="2"
                            value=""></textarea>
                </p>
                <div class="d-flex w-100 justify-content-between">
                    <small>Created by X</small>
                    <small>Assigned to X</small>
                </div>
                <div class="w-100">
                    <button class="btn btn-primary">Add</button>
                </div>
            </form>
        </li>
    </ul>
</div>