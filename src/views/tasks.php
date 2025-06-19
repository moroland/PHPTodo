<div class="list-group">
    <ul>
      <?php foreach ($tasks as $task): ?>
          <li href="#" class="list-group-item list-group-item-action">
              <form id="task-id-<?= $task->getId(); ?>" action="/task"
                    method="post">
                  <input type="hidden" name="id"
                         value="<?php echo $task->getId(); ?>">
                  <input type="hidden" name="current_page" value="<?= $current_page; ?>">
                  <div class="d-flex w-100 row">
                      <h5 class="mb-1">
                          <input class="form-check-input me-2"
                                 type="checkbox" value="1"
                            <?php if ($task->getStatus() === 1): echo 'checked'; endif; ?>
                                 id="status"
                                 name="status">
                          <input type="text"
                                 name="title"
                                 class="border-0 col-sm-10"
                                 required
                                 value="<?php echo $task->getTitle(); ?>">
                      </h5>
                  </div>
                  <p class="mb-1"><textarea
                              type="text"
                              name="description"
                              class="border-0 form-control"
                              rows="2"><?php echo $task->getDescription(); ?></textarea>
                  </p>
                  <div class="d-flex w-100 justify-content-between">
                      <small>Created by <?php echo $task->getCreator()
                          ->getUsername() ?></small>
                      <div class="input-group mb-1 row">
                          <label for="assignee" class="col-sm-2">Assign to: </label>
                          <input class="form-label border-0 col-sm-10"
                                 list="assigneeOptions"
                                 name="assignee" id="assignee"
                                 placeholder="Type to search..."
                                 value="<?php if ($task->getAssignee()) echo $task->getAssignee()->getUsername(); ?>">
                          <datalist id="assigneeOptions">
                            <?php foreach ($users as $user): ?>
                              <option value="<?php echo $user->getUsername(); ?>">
                                <?php endforeach; ?>
                          </datalist>
                      </div>
                  </div>
                  <button class="btn btn-primary">Update</button>
                  <button class="btn btn-secondary" name="delete" value="true">Delete</button>
              </form>
          </li>
      <?php endforeach; ?>
        <li class="list-group-item list-group-item-action">
            <form action="/tasks" method="post">
                <input type="hidden" name="current_page" value="<?= $current_page; ?>">
                <div class="row mb-3">
                    <div class="col-sm-1">
                        <input class="form-check-input form-control"
                               type="checkbox" value=""
                               disabled
                               id="completed">
                    </div>
                    <div class="col-sm-11">
                        <input type="text"
                               name="title"
                               class="border-0 form-control"
                               required
                               value="">
                    </div>
                </div>
                <div class="mb-3 d-flex w-100 row">
                    <textarea
                            type="text"
                            name="description"
                            class="border-0 form-control col-sm-11"
                            rows="3"></textarea>
                </div>
                <div class="input-group mb-1 row">
                    <label for="assignee" class="col-sm-2">Assign to: </label>
                    <input class="form-label border-0 col-sm-10"
                           list="assigneeOptions"
                           name="assignee" id="assignee"
                           placeholder="Type to search...">
                    <datalist id="assigneeOptions">
                      <?php foreach ($users as $user): ?>
                        <option value="<?php echo $user->getUsername(); ?>">
                          <?php endforeach; ?>
                    </datalist>
                </div>
                <div class="w-100">
                    <button class="btn btn-primary">Add</button>
                </div>
            </form>
        </li>
    </ul>
</div>